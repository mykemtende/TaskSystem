@extends('layouts.app')

@section('content')



<div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3 " style="background: white;">
<h1>Update User </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('users.update',[$user->id]) }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="put">

                            <div class="form-group">
                                <label for="user-name">Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"  
                                          id="user-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->name }}"
                                           />
                            </div>

                            <div class="form-group">
                                <label for="user-email">Email<span class="required">*</span></label>
                                <input type="email" required=""  placeholder="Enter email"  
                                          id="user-email"
                                          required
                                          name="email"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->email }}"
                                           />
                            </div>

                        <div class="form-group">
                                <label for="user-password">Password<span class="required">*</span></label>
                                <input  type="password" placeholder="Enter password"  
                                          id="user-name"
                                          required
                                          name="password"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $user->password }}"
                                           />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"
                                       value="Submit"/>
                            </div>
                        </form>
   

      </div>
</div>





    @endsection