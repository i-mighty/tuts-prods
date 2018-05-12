<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="csrf_token" content="{{csrf_token()}}">
    <title>{{config('app.name')}} || @yield('title')</title>
    <meta name="keywords" content="@yield('keywords')" />
    @yield('meta')
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.css')}}">

    <!-- Custom stlylesheet style-home.css-->
    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/style-home.css')}}"/>
    @yield('moreStyles')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{URL::asset('js/html5shiv.min.js')}}"></script>
    <script src="{{URL::asset('js/respond.min.js')}}"></script>
    <![endif]-->

</head>
<body>
    <!-- Header -->
    <header id="header" class="transparent-nav">
        <div class="container">
            @if (Route::has('login'))
                <div class="header-top">
                    <div class="container">
                        @auth
                            <div class="header-top-left visible-xs">
                                <p class="text-info"><i class="fa fa-graduation-cap"> </i><a href="{{route('home')}}"> My Courses</a></p>
                            </div>
                            <div class="header-top-right hidden-xs">
                                <a href="{{route('home')}}">
                                    <p class="text-info">
                                        <i class="fa fa-graduation-cap"></i> My Courses
                                    </p>
                                </a>
                                <a href="{{route('logout')}}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    <p class="text-primary">
                                        <i class="fa fa-user-circle"></i> Logout
                                    </p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                            @else
                                <div class="header-top-right visible-xs">
                                    <a href="{{route('login')}}">
                                        <p><i class="fa fa-user-circle-o"></i> Login</p>
                                    </a>
                                </div>
                                <div class="header-top-right hidden-xs">
                                    <a href="{{route('login')}}">
                                        <p><i class="fa fa-user-circle-o"></i> Login</p>
                                    </a>
                                    <a href="{{route('register')}}">
                                        <p><i class="fa fa-user"></i> Register</p>
                                    </a>
                                </div>
                        @endauth
                    </div>
                </div>
            @endif
            <div class="navbar-header">
                <!-- Logo -->
                <div class="navbar-brand hidden-xs">
                    <a class="logo" href="{{url('/')}}">
                        <img src="{{URL::asset('/img/logo-alt.png')}}" alt="logo">
                    </a>
                </div>
                <!-- /Logo -->

                <!-- Mobile toggle -->
                <button class="navbar-toggle">
                    <span></span>
                </button>
                <!-- /Mobile toggle -->
            </div>

            <!-- Navigation -->
            <nav id="nav">
                <ul class="main-menu nav navbar-nav navbar-right">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('/about-us')}}">About</a></li>
                    <li><a href="{{url('/courses')}}">Courses</a></li>
                    <li><a href="{{url('/contact')}}">Contact</a></li>
                    @auth
                        <li class="visible-xs"><a href="{{route('home')}}">My Courses</a></li>
                        <li><a href="{{url('/profile')}}">Profile</a></li>
                        <li class="visible-xs"><a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endauth
                    
                </ul>
            </nav>
            <!-- /Navigation -->

        </div>
    </header>
    <!-- /Header -->
    @yield('content')
    <!-- Footer -->
    <footer id="footer" class="section">
        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- footer logo -->
                <div class="col-md-6">
                    <div class="footer-logo">
                        <a class="logo" href="{{url('/')}}">
                            <img src="{{URL::asset('/img/logo.png')}}" alt="logo">
                        </a>
                    </div>
                </div>
                <!-- footer logo -->

                <!-- footer nav -->
                <div class="col-md-6">
                    <ul class="footer-nav">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('/about-us')}}">About</a></li>
                    <li><a href="{{url('/courses')}}">Courses</a></li>
                    <li><a href="{{url('/contact')}}">Contact</a></li>
                        <li><a href="{{url('/')}}">Become a Tutor</a></li>
                    </ul>
                </div>
                <!-- /footer nav -->

            </div>
            <!-- /row -->

            <!-- row -->
            <div id="bottom-footer" class="row">

                <!-- social -->
                <div class="col-md-4 col-md-push-8">
                    <ul class="footer-social">
                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <!-- /social -->

                <!-- copyright -->
                <div class="col-md-8 col-md-pull-4">
                    <div class="footer-copyright">
                        <span>&copy; Copyright 2018. All Rights Reserved. | <a href="{{url('/')}}">{{config('app.name')}}.com</a></span>
                    </div>
                </div>
                <!-- /copyright -->

            </div>
            <!-- row -->

        </div>
        <!-- /container -->

    </footer>
    <!-- /Footer -->
    <!-- preloader -->
    <div id='preloader'><div class='preloader'></div></div>
    <!-- /preloader -->
    <script type="text/javascript" src="{{URL::asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    @yield('moreScripts')
</body>
</html>