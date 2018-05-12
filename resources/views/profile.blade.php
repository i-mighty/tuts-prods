@extends('layouts.home')
@section('title',$profileUser->firstname)
@section('moreStyles')
    <style>
        .bio_t{
            min-height: 120px;
            height: auto;
            max-height: 200px;
        }
        /* Container needed to position the button. Adjust the width as needed */
        .img_holder {
            position: relative;
            width: 100%;
        }

        /* Make the image responsive */
        .img_holder img {
            width: 100%;
            height: auto;
            margin: 0 13%;
        }
        .img_holder .btn:hover{
            opacity: 100;
        }
        /* Style the button and place it in the middle of the container/image */
        .img_holder .btn {
            transition: 0.4s;
            opacity: 0;
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: #777F8C;
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .img_holder .btn:hover {
            background-color: black;
        }
    </style>
@endsection
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
                        <li>Blog</li>
                    </ul>
                    <h1 class="white-text">{{$profileUser->firstname}}</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->
    <!-- Profile-area -->
    <div class="container profile-area">
        <div id="alert" class="alerter col-md-offset-1 col-md-10 hidden-xs">
            <div class="alert fade in" align="center">

            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
        </div>

        <!-- Profile -->
        <div class="col-md-3 col-sm-4 container profile-pane">
            <div class="card bg-primary">
                @if($profileUser->is_tutor)
                    <div class="card-header bg-dark" align="center">
                        <h3 class="card-text">Tutor</h3>
                    </div>
                @endif
                <div class="img_holder" id="img_holder">
                    <img id="pic" class="img-fluid rounded-circle w-75 mt-3" src="{{URL::asset('storage/'.$profileUser->avatar)}}" alt="Card image">
                </div>
                <div class="card-body" align="center">
                    <h4 class="card-title">{{$profileUser->first_name}}  {{$profileUser->last_name}}</h4>
                    <p id="bio_p">{{$profileUser->bio}}</p>
                </div>
                @if($profileUser->id === auth()->user()->id)
                        <div class="card-body bg-warning" align="center" id="contact">
                    @else<div class="card-footer bg-warning" align="center" id="contact">
                            @endif
                    <p><i class="fa  fa-envelope-o"></i> <a class="card-link" href="#"> {{$profileUser->email}}</a></p>
                    @if(isset($profileUser->phone))
                        <p><i class="fa fa-2xx fa-mobile-phone"></i> <a class="card-link" href="#"> {{$profileUser->email}}</a></p>
                    @endif
                </div>
                           @if($profileUser->id === auth()->user()->id)
                                <div class="card-footer bg-primary">
                                    <button class="col-md-12 col-sm-12 main-button" id="btn_edit" onclick="{{'editProfile('.auth()->user()->id.')'}}">Edit Profile</button>
                                </div>
                            @endif
            </div>
        </div>
            <div id="alert" class="alerter col-md-offset-1 col-md-10 visible-xs">
                <div class="alert fade in" align="center">

                </div>
            </div>
        <!-- /Profile -->
        <!-- Activities -->
        <div class="col-md-9 col-sm-8 container">

        </div>
        <!-- /Activities -->
    </div>
    <!-- /Profile-area -->

@endsection
        @section('moreScripts')
            <script type="text/javascript" src="{{URL::asset('js/profile.js')}}"></script>
            <script type="text/javascript" src="{{URL::asset('js/render.js')}}"></script>
@endsection