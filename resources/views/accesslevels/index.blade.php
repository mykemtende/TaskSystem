@extends('layouts.app')

@section('content')

<div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3">
    <div class="panel panel-primary ">
    <div class="panel-heading">Access Levels <a  class="pull-right btn btn-primary btn-sm" href="/accesslevels/create">
    <i class="fa fa-plus-square" aria-hidden="true"></i>  Create new</a> </div>
    <div class="panel-body">
        

    <ul class="list-group">
    @foreach($accesslevels as $accesslevel)
        <li class="list-group-item"> 
        <i class="fa fa-play" aria-hidden="true"></i> <a href="/accesslevels/{{ $accesslevel->id }}" >  {{ $accesslevel->name }}</a></li>
    @endforeach
    </ul>


    </div>
    </div>
</div>

@endsection