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
                    <h1 class="white-text">Get In Touch</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section">

    <!-- container -->
    <div class="container">

        <!-- row -->
        <div class="row">
            @if(isset($submitted)&& $submitted === true)
                <div class="container" align="center" style="margin-bottom: 30px;   ">
                    <h3 align="center">Thanks for your message</h3>
                    <p class="text-success">We would get back to you soon</p>
                </div>
            @endif
            <!-- contact form -->
            <div class="col-md-6">
                <div class="contact-form">
                    <h4>Send A Message</h4>
                    <form method="post" action="{{route('submit-mailin')}}">
                        {{csrf_field()}}
                        <input class="input" type="text" name="name" placeholder="Name" required>
                        <input class="input" type="email" name="email" placeholder="Email" required>
                        @if($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <input class="input" type="userId" value=@auth"{{\Illuminate\Support\Facades\Auth::user()->id}}"@else"0"@endauth name="userId" placeholder="Email" required hidden>
                        <input class="input" type="text" name="subject" placeholder="Subject" required>
                        <textarea class="input" name="message" placeholder="Enter your Message" required maxlength="500"></textarea>
                        <p id="charCounter" style="float: center;"></p><br>
                        <button class="main-button icon-button pull-right" type="submit">Send Message</button>
                    </form>
                </div>
            </div>
            <!-- /contact form -->

            <!-- contact information -->
            <div class="col-md-5 col-md-offset-1">
                <h4>Contact Information</h4>
                <ul class="contact-details">
                    <li><i class="fa fa-envelope"></i>Educate@email.com</li>
                    <li><i class="fa fa-phone"></i>122-547-223-45</li>
                    <li><i class="fa fa-map-marker"></i>4476 Clement Street</li>
                </ul>

                <!-- contact map -->
                <div id="contact-map"></div>
                <!-- /contact map -->

            </div>
            <!-- contact information -->

        </div>
        <!-- /row -->

    </div>
    <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection
@section('moreScripts')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script type="text/javascript" src="{{URL::asset('js/google-map.js')}}"></script>
@endsection