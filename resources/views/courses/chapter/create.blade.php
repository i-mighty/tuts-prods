@extends('layouts.home')
@section('title')
    {{$course->title}} || Add new Chapter
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
                        <li>Create new Chapter</li>
                    </ul>
                    <h1 class="white-text">Create new Chapter</h1>

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
                <h4>Add new Chapter </h4>
                <form method="post" action="{{url('courses/'.$course->id.'/chapter')}}" >
                    {{csrf_field()}}
                    <input class="input" type="text" name="title" placeholder="Title" required>
                    <input class="input" type="number" name="number" placeholder="Chapter Number" required>
                    <input class="input" type="number" value=@auth"{{\Illuminate\Support\Facades\Auth::user()->id}}"@else"0"@endauth name="user_id" required hidden>
                    <input class="input" type="text" name="course_id" value="{{$course->id}}" required hidden>
                    <button class="main-button icon-button" type="submit">Save Chapter</button>
                </form>
            </div>
        </div>
        <!-- /Chapter form -->

    </div>
    <!-- /row -->
@endsection