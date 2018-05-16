@extends('layouts.app')

@section('content')

<div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3">
    All Tasks<br/>
                  <button class="dropdown">
                                <b href="" class="dropdown-toggle" 
                                data-toggle="dropdown" role="button" aria-expanded="false">
                                <i aria-hidden="true"></i>Departments <span class="caret"></span>
                                </b>
                                <ul class="dropdown-menu" role="menu">
                                 @if($departments == null)

                                  @endif

                            @if($departments != null)
                            <div class="form-group">
                                @foreach($departments as $department)
                                       <li> <a href="/departments/{{ $department->id }}" >{{ $department->name }}</a></li>
                                      @endforeach
                            </div>
                            @endif
                           
                                </ul>
                            </button>
                            <button class="dropdown">
                                <b href="" class="dropdown-toggle" 
                                data-toggle="dropdown" role="button" aria-expanded="false">
                                <i aria-hidden="true"></i>Tasks <span class="caret"></span>
                                </b>
                                <ul class="dropdown-menu" role="menu">
                               
                            <div class="form-group">
                                  <li><a href="{{ route('tasks.index') }}"><i aria-hidden="true"></i>All Tasks</a></li>
                            </div>
                            
                           
                                </ul>
                            </button>
                                  <button class="dropdown">
                                <b href="" class="dropdown-toggle" 
                                data-toggle="dropdown" role="button" aria-expanded="false">
                                <i aria-hidden="true"></i>Access level <span class="caret"></span>
                                </b>
                                <ul class="dropdown-menu" role="menu">
                                 @if($accesslevels == null)

                                  @endif

                            @if($accesslevels != null)
                            <div class="form-group">
                                @foreach($accesslevels as $accesslevel)
                                       <li> <a href="/accesslevels/{{ $accesslevel->id }}" >{{ $accesslevel->name }}</a></li>
                                      @endforeach
                            </div>
                            @endif
                           
                                </ul>
                            </button>
                            <br/><br/>
    <div class="panel panel-primary ">

    <div class="panel-heading">Tasks <a  class="pull-right btn btn-primary btn-sm" href="/tasks/create">
    Create new</a> </div>
    <div class="panel-body">
        
                             

    <ul class="list-group">
    @foreach($tasks as $task)
        <li class="list-group-item"> 
        <i class="fa fa-play" aria-hidden="true"></i>
        <a href="/tasks/{{ $task->id }}" >{{ $task->name }}</a></li>
    @endforeach
    </ul>


    </div>
    </div>
</div>

@endsection