@extends('layouts.app')
@section('title','Leads')
@section('content')
<div class="row"><div><h1 style="margin:0">Leads</h1><p class="muted">Manage, assign and track every incoming lead.</p></div><a class="btn" href="{{route('leads.create')}}">+ Add Lead</a></div>
<form method="GET" class="panel" style="margin-top:18px"><div class="form-grid">
<div class="field"><label>Search</label><input class="input" name="search" value="{{request('search')}}" placeholder="Name, email, phone or title"></div>
<div class="field"><label>Status</label><select class="select" name="status_id"><option value="">All statuses</option>@foreach($statuses as $status)<option value="{{$status->id}}" @selected((string)request('status_id')===(string)$status->id)>{{$status->name}}</option>@endforeach</select></div>
<div class="field"><label>Source</label><select class="select" name="source_id"><option value="">All sources</option>@foreach($sources as $source)<option value="{{$source->id}}" @selected((string)request('source_id')===(string)$source->id)>{{$source->name}}</option>@endforeach</select></div>
<div class="field"><label>Assignee</label><select class="select" name="assigned_to"><option value="">All owners</option>@foreach($users as $user)<option value="{{$user->id}}" @selected((string)request('assigned_to')===(string)$user->id)>{{$user->name}}</option>@endforeach</select></div>
</div><div style="margin-top:14px"><button class="btn" type="submit">Filter</button> <a class="btn secondary" href="{{route('leads.index')}}">Reset</a></div></form>
<div class="panel" style="margin-top:18px"><div class="table-wrap"><table><thead><tr><th>Lead</th><th>Contact</th><th>Source</th><th>Status</th><th>Owner</th><th>Value</th><th></th></tr></thead><tbody>
@forelse($leads as $lead)<tr><td><a href="{{route('leads.show',$lead)}}" style="font-weight:800;color:#6757ef">{{trim($lead->first_name.' '.$lead->last_name)}}</a><br><span class="muted">{{$lead->title ?: '—'}}</span></td><td>{{$lead->email ?: '—'}}<br>{{$lead->phone ?: '—'}}</td><td>{{$lead->source?->name ?: '—'}}</td><td><span class="badge">{{$lead->status?->name ?: '—'}}</span></td><td>{{$lead->assignee?->name ?: 'Unassigned'}}</td><td>{{$lead->value !== null ? $lead->currency.' '.number_format((float)$lead->value,2) : '—'}}</td><td><a class="btn secondary" href="{{route('leads.edit',$lead)}}">Edit</a></td></tr>@empty<tr><td colspan="7" style="text-align:center;padding:30px">No leads found.</td></tr>@endforelse
</tbody></table></div>{{ $leads->onEachSide(1)->links() }}</div>
@endsection