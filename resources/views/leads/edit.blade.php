@extends('layouts.app')
@section('title','Edit Lead')
@section('content')
<div class="row"><div><h1 style="margin:0">Edit Lead</h1><p class="muted">Update lead details, status and assignment.</p></div><a class="btn secondary" href="{{route('leads.show',$lead)}}">Cancel</a></div>
<div class="panel" style="margin-top:18px"><form method="POST" action="{{route('leads.update',$lead)}}">@csrf @method('PUT') @include('leads.form')<div style="margin-top:20px"><button class="btn" type="submit">Save Changes</button></div></form></div>
@endsection