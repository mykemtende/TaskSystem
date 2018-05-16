@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <marquee behavior="alternate" direction="right">Welcome to Task management System</marquee>
                <div class="panel-heading">Task System</div>

                <div class="panel-body">
                <img src="{{url ('/img/pms.jpg') }}"  alt="PMS" />

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
