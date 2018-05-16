@extends('layouts.app')

@section('content')


     
     <div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3 ">
  
      <div class="jumbotron" >
        <h1>{{ $category->name }}</h1>
        <p class="lead">{{ $category->description }}</p>
      <a href="/categories/{{ $category->id }}/edit">Edit</a>
          
                  
              <a   
              href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this Category?');
                      if( result ){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                      }
                          "
                          >
                  Delete
              </a>

              <form id="delete-form" action="{{ route('categories.destroy',[$category->id]) }}" 
                method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
              </form>

 
              
              
      </div>

      <!-- Example row of columns -->Category Tasks
      <div class="row  col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px; ">
      @foreach($category->tasks as $task)
        <div class="col-lg-4 col-md-4 col-sm-4">
          <h2>{{ $task->name }}</h2>
          <p class="text-danger"> {{$task->description}} </p>
          <p><a class="btn btn-primary" href="/tasks/{{ $task->id }}" role="button"> View task »</a></p>
        </div>
      @endforeach
      </div>
</div>

    @endsection