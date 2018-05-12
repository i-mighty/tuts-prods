@extends('layouts.home')
@section('title', 'Contact Us')
@section('content')

    <!-- Hero-area -->
    <div class="hero-area section">

    <!-- Backgound Image -->
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
    <!-- /Backgound Image -->

    <div class="container hidden-sm">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Courses</li>
                </ul>
                <h1 class="white-text">Courses</h1>

            </div>
        </div>
    </div>

    </div>
    <!-- /Hero-area -->

    <!-- Courses -->
    <div id="courses" class="section">

    <!-- container -->
    <div class="container">
        @if($empty == true)
            <!-- row -->
                <div class="row">
                    <div class="section-header text-center">
                        <h2>Couldn't find Courses</h2>
                        <p class="lead" style="margin-top: 100px;font-size: 3.5em;">Hold on We're working on it</p>
                        <p class="lead" style="margin-top: 100px;font-size: 3.5em;">Looks like there are no courses in your country</p>
                    </div>
                </div>
                <!-- /row -->
                @auth('admin')
                    <div class="row">
                        <div class="center-btn">
                            <p class="lead" >Or create new course</p>
                            <a class="main-button icon-button" href="{{url('courses/create')}}">Create Courses</a>
                        </div>
                    </div>
                @endauth()
        @else
            <!-- row -->
                <div class="row">
                    <div class="section-header text-center">
                        <h2>Explore Courses</h2>
                        <p class="lead">Designed to suit many users</p>
                    </div>
                </div>
                <!-- /row -->
            <!-- courses -->
                <div id="courses-wrapper">
                    @foreach($courses->chunk(4) as $row)
                        <!-- row -->
                        <div class="row">
                            @foreach($row as $course)
                                <!-- single course -->
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="course" align="center">
                                        <a href="{{url('courses/'.$course->id)}}" class="course-img">
                                            <img src="{{URL::asset('storage/'.$course->banner)}}" alt="">
                                            <i class="course-link-icon fa fa-link"></i>
                                        </a>
                                        <a class="course-title" href="#" align="center">{{$course->title}}</a>
                                        <a class="course-title" href="#" align="center">
                                            {{$course->owner->first_name}}  {{$course->owner->last_name}}
                                        </a>
                                        <div class="course-details" align="left">
                                            <span class="course-category">Business</span>
                                                @if($course->price === 0)
                                                <span class="course-free">
                                                    Free
                                                    @else
                                                    <span class="course-price">
                                                    ₦ {{$course->price}}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /single course -->
                                @endforeach
                        </div>
                        <!-- /row -->
                    @endforeach
                </div>
                <!-- /courses -->
                <!-- pagination -->
                {{$courses->links()}}
                <!-- pagination -->
        @endif

    </div>
    <!-- container -->

    </div>
    <!-- /Courses -->
@endsection