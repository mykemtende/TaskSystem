@extends('layouts.app')

@section('content')



     
     <div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3 " style="background: white;">
    <h1>Create new user </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('users.store') }}">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <label for="user-name">Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"  
                                          id="user-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                           />
                            </div>


                             <div class="form-group">
                                <label for="user-email">Email<span class="required">*</span></label>
                                <input type="email"  placeholder="Enter email"  
                                          id="user-email"
                                          required
                                          name="email"
                                          spellcheck="false"
                                          class="form-control"
                                           />
                            </div>
                            <div class="form-group">
                                <label for="user-password">Password<span class="required">*</span></label>
                                <input type="password"  placeholder="Enter password"  
                                          id="user-password"
                                          required
                                          name="password"
                                          spellcheck="false"
                                          class="form-control"
                                           />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary"
                                       value="Submit"/>
                            </div>
                        </form>
   

      </div>
</div>


<div class="col-sm-3 col-md-3 col-lg-3 pull-right">

        </div>


    @endsection