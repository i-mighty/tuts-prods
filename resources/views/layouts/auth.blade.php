<!DOCTYPE HTML>
<html>
    <head>
        <title>{{config('app.name')}} || @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="@yield('keywords')" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Bootstrap Core CSS -->
        <link href="{{URL::asset('css/app.css')}}" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="{{URL::asset('css/style-auth.css')}}" rel='stylesheet' type='text/css' />
        <!-- Graph CSS -->
        <link href="{{URL::asset('css/font-awesome.css')}}" rel="stylesheet">
        <!-- jQuery -->
        <!-- lined-icons -->
        <link rel="stylesheet" href="{{URL::asset('css/icon-font.min.css')}}" type='text/css' />
        <!-- //lined-icons -->
        <!-- chart -->
        <script src="{{URL::asset('js/Chart.js')}}"></script>
        <!-- //chart -->
        <!--animate-->
        <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet" type="text/css" media="all">
        <script src="{{URL::asset('js/wow.min.js')}}"></script>
            <script>
                new WOW().init();
            </script>
        <!--//end-animate-->
        <!----webfonts--->
        <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
        <!---//webfonts--->
        <!-- Meters graphs -->
        <script src="{{URL::asset('js/jquery.min.js')}}"></script>
        <!-- Placed js at the end of the document so the pages load faster -->

    </head>
    <body class="sign-in-up">
        <section>
            @yield('content')
            <!--footer section start-->
			<footer>
            <p>&copy 2015 <a href="{{url('/')}}" target="_blank">{{config('app.name')}}</a></p>
         </footer>
     <!--footer section end-->
        </section>
        <script src="{{URL::asset('js/jquery.nicescroll.js')}}"></script>
        <script src="{{URL::asset('js/scripts.js')}}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
        @section('moreScripts')
    </body>
</html>
    