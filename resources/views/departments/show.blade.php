@extends('layouts.app')

@section('content')


     
     <div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3 ">
      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <!-- Jumbotron -->
      <div class="jumbotron" >
        <h1>{{ $department->name }}</h1>
        <p class="lead">{{ $department->description }}</p>
      <a href="/companies/{{ $department->id }}/edit">Edit</a>
         

                  
              <a   
              href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this department?');
                      if( result ){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                      }
                          "
                          >
                  Delete
              </a>

              <form id="delete-form" action="{{ route('departments.destroy',[$department->id]) }}" 
                method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
              </form>

 
              
              
           
      </div>

      <!-- Example row of columns -->Department Tasks
      <div class="row  col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px; ">
      @foreach($department->tasks as $task)
        <div class="col-lg-4 col-md-4 col-sm-4">
          <h2>{{ $task->name }}</h2>
          <p class="text-danger"> {{$task->description}} </p>
          <p><a class="btn btn-primary" href="/tasks/{{ $task->id }}" role="button"> View Task »</a></p>
        </div>
      @endforeach
      </div>
</div>


<div class="col-sm-3 col-md-3 col-lg-3 pull-right">

            </ol>
          </div>

        </div>


    @endsection