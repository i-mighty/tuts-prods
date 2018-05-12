@extends('layouts.home')
@section('title')
{{$course->title}} || Chapter {{$chapter->number}} || {{$chapter->title}} || Add new Topic
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
                        <li>Courses</li>
                        <li>{{$course->title}}</li>
                        <li>Chapters</li>
                        <li>{{$chapter->title}}</li>
                        <li>Add new Topic</li>
                    </ul>
                    <h1 class="white-text">Add Topic to {{$chapter->title}}</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- row -->
    <div class="row">
        <!-- Chapter form -->
        <div class="col-md-6 col-md-offset-3">
            <div class="contact-form">
                <h4>Add new Topic to {{$chapter->title}} </h4>
                <form method="post" action="{{url('courses/'.$course->id.'/chapter/'.$chapter->id).'/topic'}}" enctype="multipart/form-data" >
                    {{csrf_field()}}
                    <input class="input" type="text" name="title" placeholder="Title" required>
                    <input class="input" type="number" value=@auth"{{\Illuminate\Support\Facades\Auth::user()->id}}"@else"0"@endauth name="user_id" required hidden>
                    <input class="input" type="text" name="course_id" value="{{$course->id}}" required hidden>
                    <input class="input" type="text" name="chapter_id" value="{{$chapter->id}}" required hidden>
                    <textarea class="input" name="text" placeholder="Topic text"></textarea>
                    <label class="category">Media file</label>
                    <input type="file" class="input" name="media_file" >
                    <button class="main-button icon-button" type="submit">Save Topic</button>
                </form>
            </div>
        </div>
        <!-- /Chapter form -->

    </div>
    <!-- /row -->
@endsection