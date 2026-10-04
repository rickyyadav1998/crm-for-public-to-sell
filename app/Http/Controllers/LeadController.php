<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::with(['source', 'status', 'assignee'])
            ->latest();

        if ($search = trim((string) $request->input('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status_id')) {
            $query->where('status_id', $request->integer('status_id'));
        }

        if ($request->filled('source_id')) {
            $query->where('source_id', $request->integer('source_id'));
        }

        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->integer('assigned_to'));
        }

        return view('leads.index', [
            'leads' => $query->paginate(15)->withQueryString(),
            'statuses' => LeadStatus::orderBy('sort_order')->get(),
            'sources' => LeadSource::where('is_active', true)->orderBy('name')->get(),
            'users' => User::where('status', 'active')->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('leads.create', [
            'statuses' => LeadStatus::orderBy('sort_order')->get(),
            'sources' => LeadSource::where('is_active', true)->orderBy('name')->get(),
            'users' => User::where('status', 'active')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['currency'] = strtoupper($data['currency'] ?? 'INR');
        $lead = DB::transaction(function () use ($data) {
            $lead = Lead::create($data);
            $lead->activities()->create([
                'user_id' => auth()->id(),
                'type' => 'created',
                'subject' => 'Lead created',
                'body' => 'Lead was added manually.',
                'created_at' => now(),
            ]);
            return $lead;
        });

        return redirect()->route('leads.show', $lead)->with('success', 'Lead created successfully.');
    }

    public function show(Lead $lead)
    {
        $lead->load(['source', 'status', 'assignee', 'activities.user', 'notes.user']);

        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        return view('leads.edit', [
            'lead' => $lead,
            'statuses' => LeadStatus::orderBy('sort_order')->get(),
            'sources' => LeadSource::where('is_active', true)->orderBy('name')->get(),
            'users' => User::where('status', 'active')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Lead $lead)
    {
        $oldStatus = $lead->status_id;
        $data = $this->validated($request);
        $data['currency'] = strtoupper($data['currency'] ?? 'INR');

        DB::transaction(function () use ($lead, $data, $oldStatus) {
            $lead->update($data);

            $lead->activities()->create([
                'user_id' => auth()->id(),
                'type' => $oldStatus != $lead->status_id ? 'status_changed' : 'updated',
                'subject' => $oldStatus != $lead->status_id ? 'Lead status changed' : 'Lead updated',
                'body' => null,
                'created_at' => now(),
            ]);
        });

        return redirect()->route('leads.show', $lead)->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        $name = trim($lead->first_name . ' ' . $lead->last_name);
        $lead->delete();

        return redirect()->route('leads.index')->with('success', "{$name} was deleted.");
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'],
            'title' => ['nullable', 'string', 'max:190'],
            'value' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'size:3'],
            'source_id' => ['nullable', 'exists:lead_sources,id'],
            'status_id' => ['nullable', 'exists:lead_statuses,id'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);
    }
}
