@extends('layouts.app')

@section('content')
   
     <div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3 ">
      <div class="well well-lg" >
        <h1>{{ $project->name }}</h1>
        <p class="lead">{{ $project->description }}</p>
         <li><a href="/projects/{{ $project->id }}/edit">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
              Edit</a></li>

            @if($project->user_id == Auth::user()->id)
            
              <li>
              <i class="fa fa-power-off" aria-hidden="true"></i>
              <a   
              href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this project?');
                      if( result ){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                      }
                          "
                          >
                  Delete
              </a>

              <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}" 
                method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
              </form>

              </li>
 @endif
                </div>

      <div class="row  col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px; ">
<br/>

@include('comments.comments')


<div class="row container-fluid">

<form method="post" action="{{ route('comments.store') }}">
                            {{ csrf_field() }}


                            <input type="hidden" name="commentable_type" value="App\Project">
                            <input type="hidden" name="commentable_id" value="{{$project->id}}">


                            <div class="form-group">
                                <label for="comment-content">Comment</label>
                                <textarea placeholder="Enter comment" 
                                          style="resize: vertical" 
                                          id="comment-content"
                                          name="body"
                                          rows="3" spellcheck="false"
                                          class="form-control autosize-target text-left">

                                          
                                          </textarea>
                            </div>




                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"
                                       value="Submit"/>
                            </div>
                        </form>
   


                        </div>

                      

      </div>
</div>
   
<div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3">

            </ol>
<hr/>

      
              </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
<br/>

            </ol>

          </div>

        </div>

@endsection







