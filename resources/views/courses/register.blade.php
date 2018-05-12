@extends('layouts.home')
@section('title')
    Register for {{$course->title}}
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
                        <li>Register</li>
                    </ul>
                    <h1 class="white-text">{{$course->title}}</h1>
                    <ul class="blog-post-meta">
                            <li class="blog-meta-author">
                                @if($course->owner_type === 'user')
                                    <a href="{{url('profile/'.$course->user_id)}}">
                                        {{$course->owner->firstname}} {{$course->owner->lastname}}
                                    </a>
                                @elseif($course->owner_type === 'admin')
                                    <p>
                                        {{$course->owner->firstname}} {{$course->owner->lastname}}
                                    </p>
                                @endif

                            </li>
                        <li>{{$course->created_at}}</li>
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
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- blog post -->
                <div class="container">
                    <div class="row" align="center">
                        <div class="col-md-12 col-sm-12" >
                            <div class="tab col-md-4" role="tabpanel" style="border: 1px solid rosybrown;">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" align="center">
                                    <h3 class="blue-text">Introduction</h3>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabs">
                                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                                        <div id="text-holder">
                                            <p>{!! preg_replace('/\r\n/',"</p><p>",$course->description) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab col-md-4" role="tabpanel" style="border: 1px solid rosybrown; height: 100; " >
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" align="center">
                                    <h3 class="blue-text">Course Content</h3>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabs">
                                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                                        <h3><i class="fa fa-fw fa-sitemap"></i> <br> {{$course->title}}</h3>
                                        <ul>
                                            <li class="nav-item category">Introduction</li>
                                            @foreach($course->chapters as $chapter)
                                                <li class="nav-item category" data-toggle="tooltip" data-placement="right" title="Chapter: {{$chapter->title}}">
                                                    <a class="nav-link chapter-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti">
                                                        <i class="fa fa-fw fa-bookmark"></i>
                                                        <span class="">{{$chapter->title}}</span>
                                                    </a>
                                                    <ul class="sidenav-second-level collapse in" id="collapseMulti" style="margin-left: 50px;">
                                                        @foreach($chapter->topics as $topic)
                                                            <li class="nav-item category topic-link" data-toggle="tooltip" data-placement="right" title="Topic: {{$topic->title}}">
                                                                @isset($topic->text)
                                                                    <i class="fa fa-fw fa-file-text"></i>
                                                                @endisset
                                                                @isset($topic->media) <i class="fa fa-fw fa-play-circle"></i>@endisset
                                                                <a href="#" onclick="event.preventDefault();
                                                    {{'cast('.$course->id.','.$chapter->id.','.$topic->id.')'}}">{{$topic->title}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab col-md-4" role="tabpanel" style="border: 1px solid rosybrown;">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" align="center">
                                    <h3 class="blue-text">Additional Information</h3>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabs">
                                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                                        <ul class="list-group">
                                            <li class="list-group-item"><i class="fa fa-fw fa-clock-o"></i> Created: {{$course->created_at}}</li>
                                            <li class="list-group-item"><i class="fa fa-fw fa-users"></i> Registered Students: {{$course->registrations()->count()}}</li>
                                            <li class="list-group-item"><i class="fa fa-fw fa-money"></i> Fee: {{$course->price}}</li>
                                            <li class="list-group-item"><i class="fa fa-fw fa-bullseye"></i> Time target: No</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <form method="post" action="{{route('course.register')}}">
                                {{csrf_field()}}
                                <input name="course" value="{{$course->id}}" type="number" hidden>
                                <button type="submit" class="main-button submit-buttom" href="">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /blog post -->

                <!-- blog share -->
                <div class="blog-share">
                    <h4>Share This Post:</h4>
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                </div>
                <!-- /blog share -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection