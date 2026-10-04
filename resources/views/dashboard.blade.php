@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="row"><div><h1 style="margin:0">Dashboard</h1><p class="muted">Your CRM at a glance.</p></div><a class="btn" href="{{route('leads.create')}}">+ Add Lead</a></div>
<div class="grid" style="margin-top:18px">
<div class="panel stat"><div class="label">Total leads</div><div class="value">{{$totalLeads}}</div><a class="muted" href="{{route('leads.index')}}">View all →</a></div>
<div class="panel stat"><div class="label">New leads</div><div class="value">{{$newLeads}}</div><a class="muted" href="{{route('leads.index',['status_id'=>1])}}">Open leads →</a></div>
<div class="panel stat"><div class="label">Open deal value</div><div class="value">₹{{number_format((float)$openDealsValue,2)}}</div><span class="muted">Across open deals</span></div>
</div>
<div class="panel" style="margin-top:18px"><div class="row"><div><h2 style="margin:0">Recent leads</h2><p class="muted">Latest activity in your database.</p></div><a class="btn secondary" href="{{route('leads.index')}}">Manage leads</a></div>
<div class="table-wrap"><table><thead><tr><th>Name</th><th>Source</th><th>Status</th><th>Owner</th><th>Created</th></tr></thead><tbody>
@forelse($recentLeads as $lead)<tr><td><a href="{{route('leads.show',$lead)}}" style="font-weight:800;color:#6757ef">{{trim($lead->first_name.' '.$lead->last_name)}}</a></td><td>{{$lead->source?->name ?? '—'}}</td><td><span class="badge">{{$lead->status?->name ?? '—'}}</span></td><td>{{$lead->assignee?->name ?? 'Unassigned'}}</td><td>{{$lead->created_at?->format('d M Y, h:i A')}}</td></tr>
@empty<tr><td colspan="5" style="padding:30px;text-align:center">No leads yet. Add your first lead to start.</td></tr>@endforelse
</tbody></table></div></div>
@endsection
