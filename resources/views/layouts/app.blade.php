<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Task Management System</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
            <script src="{{ asset('js/responsive.js') }}"></script>

<!--     <script src="https://use.fontawesome.com/874dbadbd7.js"></script>
 -->

</head>
<body>
    <div id="app">
        <nav style="background: lightblue;" class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger f-->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                     TMS
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                            <li><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
                        @else

                <ul class="nav navbar-nav side-nav">
               <li  class="btn btn-lg">
                   <a href="/home" data-toggle="collapse" data-target="#demop">   Task Management System<i class=""></i></a>
                    </li>
                <li  class="btn btn-lg">
                   <a href="/home" data-toggle="collapse" data-target="#demop">Dashboard<i class=""></i></a>
                    </li>  
                <li class="btn btn-lg ">
                   <a href="javascript:;" data-toggle="collapse" data-target="#demow">Projects<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demow" class="collapse">
                            <li>
                                <a href="{{ route('projects.index') }}" class="fa fa-briefcase">&nbsp;My Projects </a>
                            </li>
                            <li>
                                <a href="{{ route('projects.create') }}" class="glyphicon glyphicon-plus">&nbsp;Create Project </a>
                            </li>
                       
                        </ul>
                    </li>

                <li class="btn btn-lg">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demor"></i> User Board <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demor" class="collapse">
                            <li>
                                <a href="{{ route('users.index') }}" class="fa fa-user">&nbsp;Users</a>
                            </li>
                                <li>
                                <a href="{{ route('users.create') }}" class="glyphicon-plus">&nbsp;create user</a>
                            </li>
                        </ul>
                    </li>

                   <li class="btn btn-lg">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo">Task and Followup<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="{{ route('tasks.index') }}" class="fa fa-tasks">&nbsp;Tasks</a>
                            </li>
                            <li>
                                <a href="{{ route('tasks.create') }}" class="glyphicon-plus">&nbsp;create task</a>
                            </li>
                           
                        </ul>
                    </li>

                </ul>

                            @if(Auth::user()->role_id == 1)


                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" 
                                data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i> SuperUser <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('projects.index') }}"><i class="fa fa-briefcase" aria-hidden="true"></i>Projects</a></li>
                                <li><a href="{{ route('users.index') }}"><i class="fa fa-user" aria-hidden="true"></i> Users</a></li>
                                <li><a href="{{ route('tasks.index') }}"><i class="fa fa-tasks" aria-hidden="true"></i> Tasks</a></li>
                                <li><a href="{{ route('categories.index') }}"><i class="fa fa-building" aria-hidden="true"></i> Categories</a></li>
                                <li><a href="{{ route('departments.index') }}"><i class="fa fa-envelope" aria-hidden="true"></i> Departments</a></li>

                                </ul>
                            </li>

@endif


                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" 
                                data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>  {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fa fa-power-off" aria-hidden="true"></i>  Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container" >

        @include('comments.errors')
        @include('comments.success')

            <div class="row">
                @yield('content')
            
            </div>
         </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/responsive.js') }}"></script>

    @yield('jqueryScript')
</body>
</html>
