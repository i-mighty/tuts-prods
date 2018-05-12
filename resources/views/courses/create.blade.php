@extends('layouts.home')
@section('title')
    {{$authUser->first_name}} || Create new Course
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
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Courses</li>
                        <li>Create new Course</li>
                    </ul>
                    <h1 class="white-text">Create new Course</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- New Course -->
    <div id="new-course" class="section">

    <!-- container -->
    <div class="container">

        <!-- row -->
        <div class="row">
            <!-- contact form -->
            <div class="col-md-6 col-md-offset-3">
                <div class="contact-form">
                    <h4>Create new Course</h4>
                    <form method="post" action="{{url('/courses')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input class="input" type="text" name="title" placeholder="Title" required>
                        @if($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                        <!-- Need to work with tags -->
                        <!-- <input class="input" type="text" name="categories" placeholder="Catogories" required> -->
                        <div class="input-group input">
                            <span class="input-group-addon">Naira (₦)</span>
                            <input inputMode="number" class="form-control" name="price" placeholder="Price">
                        </div>
                        <input class="input" type="text" name="categories" placeholder="Categories" required>
                        <div class="input-group input">
                            <input class="form-control-file" type="file" id="banner" name="banner" placeholder="Course Picture" required>
                        </div>
                        <input class="input" type="number" value=@if(\Illuminate\Support\Facades\Auth::check() || \Illuminate\Support\Facades\Auth::guard('admin'))"{{$authUser->id}}"@else"0"@endif name="user_id" placeholder="Email" required hidden>
                        <textarea class="input" name="description" placeholder="Short description of your course" required maxlength="500"></textarea>
                        <button class="main-button icon-button" type="submit">Save Course</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- /row -->

    </div>
    <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection