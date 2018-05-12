@extends('layouts.home')
@section('title', '')
@section('content')

<!-- Hero-area -->
<div class="hero-area section">

    <!-- Backgound Image -->
    <div class="bg-image bg-parallax overlay" style="background-image:url({{URL::asset('/img/page-background.jpg')}})"></div>
    <!-- /Backgound Image -->

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.html">Home</a></li>
                    <li>My Courses</li>
                </ul>
                <h1 class="white-text">{{$authUser->firstname}}</h1>

            </div>
        </div>
    </div>

</div>
<!-- /Hero-area -->

<!-- Blog -->
<div id="blog" class="section">

    <!-- container -->
    <div class="container">

        <!-- row -->
        <div class="row">

            <!-- main blog -->
            <div id="main" class="col-md-9 col-sm-12">

                <!-- row -->
                <div class="row">
                <h3 align="center">Registered Courses</h3>
                    @if($courses->count() === 0)
                        <!-- No courses -->
                            <p class="lead" align="center">
                                <i class="fa fa-2x fa-ellipsis-h"></i>
                                <br><br>
                                No Courses
                            </p>
                            <!-- /No courses -->
                    @else
                        @foreach($courses as $course)
                            <!-- single blog -->
                                @php
                                    $array = explode(' ', $course->updated_at);
                                    $date = explode('-', $array[0]);
                                    $time = explode(':', $array[1]);
                                @endphp
                                <div class="col-md-6 col-sm-6">
                                    <div class="single-blog">
                                        <div class="blog-img">
                                            <a href="{{url('courses/'.$course->id)}}">
                                                <img src="{{URL::asset('storage/'.$course->banner)}}" alt="">
                                            </a>
                                        </div>
                                        <h4><a href="blog-post.html">{{$course->title}}</a></h4>
                                        <div class="blog-meta">
                                            <span class="blog-meta-author">By: <a href="#">{{$course->owner->first_name}} {{$course->owner->last_name}}</a></span>
                                            <div class="pull-right">
                                                <span>{{Carbon\Carbon::createFromDate($date[0],$date[1],$date[2])->diffForHumans()}}</span>
                                                <span class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> {{$course->registrations()->count()}}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /single blog -->
                            @endforeach
                    @endif
                </div>
                <!-- /row -->
                
                <!--pagination-->
                <div class="col-md-12">
                    {{$courses->links()}}
                </div>
                <!--/pagination-->

            </div>
            <!-- /main blog -->

            <!-- aside blog -->
            <div id="aside" class="col-md-3 col-sm-12">

                <!-- category widget -->
                <!-- <div class="widget category-widget col-md-12 col-sm-6">
                    <h3>Categories</h3>
                    <a class="category" href="#">Web <span>12</span></a>
                    <a class="category" href="#">Css <span>5</span></a>
                    <a class="category" href="#">Wordpress <span>24</span></a>
                    <a class="category" href="#">Html <span>78</span></a>
                    <a class="category" href="#">Business <span>36</span></a>
                </div> -->
                <!-- /category widget -->

                <!-- posts widget -->
                <div id="completed" class="widget posts-widget col-md-12 col-sm-6">
                    <h3 align="center">Completed Courses</h3>
                    @if($completed->count() == 0)
                        <!-- No courses -->
                        <div style="margin:auto;" align="center">
                            <i class="fa fa-2x fa-ellipsis-h"></i>
                            <h5>No Courses</h5>
                        </div>
                        <!-- /No courses -->     
                    @else
                    @foreach($completed as $course)
                    @php
                            $array = explode(' ', $course->updated_at);
                            $date = explode('-', $array[0]);
                            $time = explode(':', $array[1]);
                        @endphp
                        <!-- single course -->
                        <div class="single-post">
                            <a class="single-post-img" href="{{url('courses/'.$course->id)}}">
                                <img src="{{URL::asset('storage/'.$course->banner)}}" alt="">
                            </a>
                            <a href="{{url('courses/'.$course->id)}}">{{$course->title}}</a>
                            <p><small>By : {{$course->user->firstname}} {{Carbon\Carbon::createFromDate($date[0],$date[1],$date[2])->diffForHumans()}}</small></p>
                        </div>
                        <!-- /single course -->
                    @endforeach
                        
                    @endif
                    <!-- pagination -->
                    <div class="col-md-12">
                        <div class="post-pagination">
                            {{$completed->links()}}
                        </div>
                    </div>
                    <!-- pagination -->

                </div>
                <!-- /posts widget -->

                <!-- tags widget -->
                <!-- <div class="widget tags-widget col-sm-12">
                    <h3>Tags</h3>
                    <a class="tag" href="#">Web</a>
                    <a class="tag" href="#">Photography</a>
                    <a class="tag" href="#">Css</a>
                    <a class="tag" href="#">Responsive</a>
                    <a class="tag" href="#">Wordpress</a>
                    <a class="tag" href="#">Html</a>
                    <a class="tag" href="#">Website</a>
                    <a class="tag" href="#">Business</a>
                </div> -->
                <!-- /tags widget -->

            </div>
            <!-- /aside blog -->

        </div>
        <!-- row -->

    </div>
    <!-- container -->

</div>
<!-- /Blog -->

@endsection
