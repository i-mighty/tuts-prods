@extends('layouts.home')
@section('title')
    {{$course->title}} || Edit
@endsection
@section('meta')
@endsection
@section('moreStyles')
    <link rel="stylesheet" href="{{URL::asset('css/sb-admin.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('css/loading.css')}}"/>
    <style type="text/css">
        button[data-toggle="dropdown"], a[data-toggle="collapse"]{padding: 2px;}
        .input-group-btn ul > li > a, .input-group-btn ul > .divider{
            padding: 0px 5px; margin: 2px;text-align: center;
        }
        .main-button{
            padding: 2px 20px;
        }
        .btn-group{
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
    <!-- Hero-area -->
    <div class="hero-area section">
        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{URL::asset('storage/'.$course->banner)}})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="blog.html">Courses</a></li>
                        <li>{{$course->title}}</li>
                    </ul>
                    <h1 class="white-text">{{$course->title}}</h1>
                    <ul class="blog-post-meta">
                        @if($authUser->id === $course->owner->id)
                            <li class="blog-meta-author">
                                <a href="{{url('courses/'.$course->id.'?s_t=preview')}}"> Preview </a>
                            </li>
                        @else
                            @php if (auth('admin')->user()->id === $course->id){

                            } @endphp
                        @endif
                        <li></li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-comments"></i> 35</a></li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i>{{$course->registrations->count()}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Hero-area -->
    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container-fluid">
            <div id="alert" class="alerter col-md-offset-1 col-md-10 hidden-xs">
                <div class="alert fade in" align="center">

                </div>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
            </div>
            <!-- row -->
            <div class="row">

                <!-- aside blog -->
                <div id="aside" class="col-md-3 col-md-offset-1 col-sm-3">

                    <!-- category widget -->
                    <div class="widget category-widget">
                        <h3 align="center"><i class="fa fa-fw fa-book"></i> <br>{{$course->title}}</h3>
                        <button class="btn-link" align="center" onclick="{{'intro('.$course->id.')'}}">Introduction</button>
                        <ul>
                            @foreach($course->chapters as $chapter)
                                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Chapter: {{$chapter->title}}" style="margin:10px 0px;">
                                    <form id="{{'ch_'.$chapter->id}}">
                                        {{csrf_field()}}
                                        <div class="input-group" align="center">
                                            <input class="form-control" id="{{'ch_'.$chapter->id.'tl'}}" name="title" style="border: 0px;" placeholder="{{$chapter->title}}">
                                            <div class="input-group-btn">
                                                <button style="border-radius: 0em;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-fw fa-cog"></i>
                                                    <i class="fa fa-fw fa-caret-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right" style="border-radius: 0em;">
                                                    <li class=""><a href="" onclick="event.preventDefault();
                                                                                        {{'chapterRename('.$course->id.','.$chapter->id.')'}}" class="btn-secondary">Rename</a></li>
                                                    <li class="divider"></li>
                                                    <li class=""><a href="" onclick="event.preventDefault();
                                                                                        {{'chapterDelete('.$course->id.','.$chapter->id.')'}}" class="btn-dark">Delete</a></li>
                                                </ul>
                                            </div>
                                            <div class="input-group-btn">
                                                <a type="button" class="btn btn-default nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti{{$chapter->id}}">
                                                    <i class="fa fa-fw fa-chevron-down expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="sidenav-second-level collapse" id="collapseMulti{{$chapter->id}}"  style="padding-left: 15px; margin: 10px 0px;">
                                        @foreach($chapter->topics as $topic)
                                            <li class="nav-item" style="margin: 10px 0px;">
                                                <div class="input-group">
                                                    <input class="form-control " id="{{'tp_'.$topic->id.'tl'}}" style="border: 0px;" placeholder="{{$topic->title}}">
                                                    <div class="input-group-btn">
                                                        <button style="border-radius: 0em;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-fw fa-cog"></i>
                                                            <i class="fa fa-fw fa-caret-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" style="border-radius: 0em;">
                                                            <li class=""><a href="" onclick="event.preventDefault();
                                                                                        {{'topicRename('.$course->id.','.$chapter->id.','.$topic->id.')'}}" class="btn-secondary">Rename</a></li>
                                                            <li class="divider"></li>
                                                            <li class=""><a href="" onclick="event.preventDefault();
                                                                                        {{'editCast('.$course->id.','.$chapter->id.','.$topic->id.')'}}" class="btn-dark">Edit</a></li>
                                                            <li class="divider"></li>
                                                            <li class=""><a href="" onclick="event.preventDefault();
                                                                                        {{'topicDelete('.$course->id.','.$chapter->id.','.$topic->id.')'}}" class="btn-dark">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        <a class="category" href="{{url('courses/'.$course->id.'/chapter/'.$chapter->id.'/topic/create')}}">
                                            <button class="main-button">
                                                <i class="fa fa-fw fa-plus"></i>
                                                Add Topic
                                            </button>
                                        </a>
                                    </ul>
                                </li>
                            @endforeach
                            <a class="category" href="{{url('courses/'.$course->id.'/chapter/create')}}">
                                <button class="main-button " >
                                    <i class="fa fa-fw fa-file-text-o"></i>
                                    New Chapter
                                </button>
                            </a>
                        </ul>
                    </div>
                    <a class="col-md-12 col-sm-12" href="{{url('courses/'.$course->id.'/chapter/create')}}">
                        <button class="main-button" >
                            Make Test
                            <i class="fa fa-fw fa-graduation-cap"></i>
                        </button>
                    </a>
                </div>
                <div id="alert" class="alerter col-md-offset-1 col-md-10 visible-xs">
                    <div class="alert fade in" align="center">

                    </div>
                </div>
                <!-- /aside blog -->

                <!-- main blog -->
                <div id="main" class="col-md-7 col-sm-9">

                    <!-- blog post -->
                    <div class="blog-post contact-form" id="topic-holder">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="media-pane" style="margin-bottom: 20px;"></div>
                        <output id="tmp-media" class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;"></output>
                        <form id="thiscourse" enctype="multipart/form-data">
                            <textarea id="text-holder" name="text" class="input" cols="300">{{$course->description}}</textarea>
                            <input type="submit" class="category col-md-12 col-sm-12 col-xs-12 main-button" id="submit-course" value="Save changes" style="display: none">
                        </form>
                    </div>
                    <!-- /blog post -->

                </div>
                <!-- /main blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection
@section('moreScripts')
    <script type="text/javascript">$('#text-holder').after('<button id="intro" class="col-md-12 main-button" onclick="{{'intro('.$course->id.')'}}">Save Introduction</button>')</script>
    <script type="text/javascript" src="{{URL::asset('js/edit.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/render.js')}}"></script>
@endsection