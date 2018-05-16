@extends('layouts.app')

@section('content')


     
     <div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3 ">

      <div class="well well-lg" >
        <h1>Name: {{ $task->name }}</h1>
        <p class="lead">Deaprtment: {{ $task->department->name }}</p>
         <p class="lead">Due Date: {{ $task->duedate }}</p>
          <p class="lead">Priority: {{ $task->priority }}</p>
           <p class="lead">Description: {{ $task->description }}</p>
            <a href="/tasks/{{ $task->id }}/edit">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
              Edit</a>
        <br/>


            @if($task->user_id == Auth::user()->id)
            
            
              <i class="fa fa-power-off" aria-hidden="true"></i>
              <a   
              href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this task?');
                      if( result ){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                      }
                          "
                          >
                  Delete
              </a>

              <form id="delete-form" action="{{ route('tasks.destroy',[$task->id]) }}" 
                method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
              </form>

              
 @endif
      </div>

      <!-- Example row of columns -->
      <div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3" style="background: white; margin: 10px; ">
<br/>

@include('comments.comments')


<div class="row container-fluid">

<form method="post" action="{{ route('comments.store') }}">
                            {{ csrf_field() }}


                            <input type="hidden" name="commentable_type" value="App\Task">
                            <input type="hidden" name="commentable_id" value="{{$task->id}}">


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
@section('jqueryScript')
                      <script type="text/javascript">
                      
                            $('#addMember').on('click',function(e){
                              e.preventDefault(); //prevent the form from auto submit


                            var formData = {
                              'task_id' : $('#task_id').val(),
                              'email' : $('#email').val(),
                              '_token': $('input[name=_token]').val(),
                            }

                            var url = 'tasks/adduser';

                            $.ajax({
                              type: 'post',
                              url: "{{ URL::route('tasks.adduser') }}",
                              data : formData,
                              dataType : 'json',
                              success : function(data){

                                    var emailField = $('#email').val();
                                  
                                  $('#member-list').prepend('<li><a href="#">'+ emailField +'</a> </li>');
                                  $('#email').val('');
                              },
                              error: function(data){
                                //do something with data
                                console.log("error sending ajax request" + data);
                              }
                            });

                             
                            });

                      </script>




<div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3">

            </ol>
<hr/>

            <h4>Assign task members</h4>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12  col-sm-12 ">
              <form id="add-user" action="{{ route('tasks.adduser') }}"  method="POST" >
                {{ csrf_field() }}
                <div class="input-group"> 
                  <input class="form-control" name = "task_id" id="task_id" value="{{$task->id}}" type="hidden">
                  <input type="text" required class="form-control" id="email"  name = "email" placeholder="Email">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="addMember" >Add</button>
                  </span>
                </div><!-- /input-group -->
                </form>
              </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
<br/>
            <h4>Assigned Task Members</h4>
            <ol class="list-unstyled" id="member-list">
            @foreach($task->users as $user)
              <li>Click<a href="/users/{{$task->user->id}}"> {{$user->email}} </a>to view details </li>
              
              @endforeach
            </ol>

          </div>

        </div>


    @endsection

@endsection    






