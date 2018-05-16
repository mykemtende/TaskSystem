@extends('layouts.app')

@section('content')
     <div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3 " style="background: white;">
    <h1>Create access level </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('accesslevels.store') }}">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <label for="accesslevel-name">Name<span class="required">*</span></label>
                                <input   placeholder="Enter accesslevel name"  
                                          id="accesslevel-name"
                                          required
                                          name="name"
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




    @endsection