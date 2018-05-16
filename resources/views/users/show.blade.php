@extends('layouts.app')

@section('content')


     
     <div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3 ">
      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <!-- Jumbotron -->
      <div class="jumbotron" >
        <h1>{{ $user->name }}</h1>
        <p class="lead">{{ $user->email }}</p>
   <a href="/users/{{ $user->id }}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
Edit</a>
              

                            <i class="fa fa-power-off" aria-hidden="true"></i>
    
              <a   
              href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this User?');
                      if( result ){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                      }
                          "
                          >
                  Delete
              </a>

              <form id="delete-form" action="{{ route('users.destroy',[$user->id]) }}" 
                method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
              </form>

 
              
              
              
      </div>

 
</div>





    @endsection