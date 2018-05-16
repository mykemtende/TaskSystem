@extends('layouts.app')

@section('content')

<div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3">
    <div class="panel panel-primary ">
    <div class="panel-heading">Users <a  class="pull-right btn btn-primary btn-sm" href="/users/create">
    Create new</a> </div>
    <div class="panel-body">
        

    <ul class="list-group">
    @foreach($users as $user)
        <li class="list-group-item"> 
        <i class="fa fa-play" aria-hidden="true"></i>
        <a href="/users/{{ $user->id }}" >{{ $user->name }}</a></li>
    @endforeach
    </ul>


    </div>
    </div>
</div>

@endsection