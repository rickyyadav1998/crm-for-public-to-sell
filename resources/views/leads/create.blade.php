@extends('layouts.app')
@section('title','Add Lead')
@section('content')
<div class="row"><div><h1 style="margin:0">Add Lead</h1><p class="muted">Create a lead manually. Integrations will use the same lead pipeline.</p></div><a class="btn secondary" href="{{route('leads.index')}}">Back</a></div>
<div class="panel" style="margin-top:18px"><form method="POST" action="{{route('leads.store')}}">@csrf @include('leads.form')<div style="margin-top:20px"><button class="btn" type="submit">Create Lead</button></div></form></div>
@endsection