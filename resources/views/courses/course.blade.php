@extends('layouts.home')
@section('title')
    Course || {{$course->title}}
@endsection
@section('moreStyles')
    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/sb-admin.css')}}"/>
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
                    @if($authUser->id === $course->owner_id)
                        <li class="blog-meta-author">
                            <a href="{{url('courses/'.$course->id.'/edit')}}"> Edit </a>
                        </li>
                    @else
                        <li class="blog-meta-author">
                            @if($course->owner_type === "admin")
                                <p class="text-light">{{$course->owner->first_name}} {{$course->owner->last_name}}</p>
                            @else
                                <a href="{{url('profile/'.$course->user_id)}}">
                                    {{$course->owner->first_name}} {{$course->owner->last_name}}
                                </a>
                            @endif
                        </li>
                    @endif
                <li>18 Oct, 2017</li>
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

        <!-- row -->
        <div class="row">

            <!-- aside blog -->
            <div id="aside" class="col-md-3 col-md-offset-1 col-sm-4">

                <!-- category widget -->
                <div class="widget category-widget">
                    <h3 align="center"><i class="fa fa-fw fa-sitemap"></i> <br><br> {{$course->title}}</h3>
                    <ul>
                        <li class="nav-item category" >Introduction</li>
                        @foreach($course->chapters as $chapter)
                            <li class="nav-item category" data-toggle="tooltip" data-placement="right" title="Chapter: {{$chapter->title}}">
                                <a class="nav-link chapter-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti{{$chapter->number}}">
                                    <i class="fa fa-fw fa-bookmark"></i>
                                    <span class="">{{$chapter->title}}</span>
                                </a>
                                <ul class="sidenav-second-level collapse" id="collapseMulti{{$chapter->number}}">
                                    @foreach($chapter->topics as $topic)
                                        <li class="nav-item category topic-link" data-toggle="tooltip" data-placement="right" title="Topic: {{$topic->title}}">
                                            @isset($topic->text)<i class="fa fa-fw fa-file-text"></i>@endisset
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

                <div>
                    <a href="{{url('courses/'.$course->id.'/test')}}">
                        <button class="main-button icon-button pull-right" style="padding: 10px 30px">Take test</button>
                    </a>
                </div>

            </div>
            <!-- /aside blog -->

            <!-- main blog -->
            <div id="main" class="col-md-7 col-sm-8">

                <!-- blog post -->
                <div class="blog-post" id="topic-holder">
                    <div id="text-holder">
                        <p>{!! preg_replace('/\r\n/',"</p><p>",$course->description) !!}</p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" id="media-pane" style="margin-bottom: 20px;">
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

                <!-- blog comments -->
                <div class="blog-comments">
                    @if($course->comments()->count() > 0)
                        <h3>5 Comments</h3>
                        @foreach($course->comments as $comment)
                            @php
                                $array = explode(' ', $comment->updated_at);
                                $date = explode('-', $array[0]);
                                $time = explode(':', $array[1]);
                            @endphp
                            <!-- single comment -->
                                <div class="media">
                                    {{--<div class="media-left">--}}
                                        {{--<img src="./img/avatar.png" alt="">--}}
                                    {{--</div>--}}
                                    <div class="media-body">
                                        {{--<h4 class="media-heading">John Doe</h4>--}}
                                        <p>{{$comment->content}}</p>
                                        <div class="date-reply"><span>{{Carbon\Carbon::createFromDate($date[0],$date[1],$date[2])->diffForHumans()}}</span><a href="#" class="reply">Reply</a></div>
                                    </div>
                                    @foreach($comment->comments as $reply)
                                        @php
                                            $array = explode(' ', $reply->updated_at);
                                            $date = explode('-', $array[0]);
                                            $time = explode(':', $array[1]);
                                        @endphp
                                        <!-- comment reply -->
                                            <div class="media">
                                                {{--<div class="media-left">--}}
                                                    {{--<img src="./img/avatar.png" alt="">--}}
                                                {{--</div>--}}
                                                <div class="media-body">
                                                    {{--<h4 class="media-heading">John Doe</h4>--}}
                                                    <p>{{$reply->content}}</p>
                                                    <div class="date-reply"><span>{{Carbon\Carbon::createFromDate($date[0],$date[1],$date[2])->diffForHumans()}}</span><a href="#" class="reply">Reply</a></div>
                                                </div>
                                            </div>
                                            <!-- /comment reply -->
                                    @endforeach

                                </div>
                                <!-- /single comment -->
                        @endforeach
                    @else
                @endif
                    <!-- blog reply form -->
                    <div class="blog-reply-form">
                        <h3>Leave Comment</h3>
                        <form>
                            @auth()@else
                                <input class="input name-input" type="text" name="name" placeholder="Name" required>
                                <input class="input email-input" type="email" name="email" placeholder="Email" required>
                                @endauth
                            <textarea class="input" name="message" placeholder="Enter your Message"></textarea>
                            <button class="main-button icon-button">Submit</button>
                        </form>
                    </div>
                    <!-- /blog reply form -->

                </div>
                <!-- /blog comments -->
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
    <script type="text/javascript" src="{{URL::asset('js/render.js')}}"></script>
@endsection