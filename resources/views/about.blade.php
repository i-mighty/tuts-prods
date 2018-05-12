@extends('layouts.home')
@section('title', 'Contact Us')
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
                        <li>Contact</li>
                    </ul>
                    <h1 class="white-text">Who We Are</h1>

                </div>
            </div>
        </div>
    </div>
@endsection