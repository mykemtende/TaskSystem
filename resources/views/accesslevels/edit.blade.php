@extends('layouts.app')

@section('content')



<div class="col-md-8 col-lg-8 col-md-offset-3  col-lg-offset-3 " style="background: white;">
<h1>Update category </h1>

      <!-- Example row of columns -->
      <div class="row  col-md-12 col-lg-12 col-sm-12" >

      <form method="post" action="{{ route('accesslevels.update',[$accesslevel->id]) }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="put">

                            <div class="form-group">
                                <label for="accesslevel-name">Name<span class="required">*</span></label>
                                <input   placeholder="Enter name"  
                                          id="accesslevel-name"
                                          required
                                          name="name"
                                          spellcheck="false"
                                          class="form-control"
                                          value="{{ $accesslevel->name }}"
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