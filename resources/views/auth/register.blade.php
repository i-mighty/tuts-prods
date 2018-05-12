@extends('layouts.auth')
@section('title', 'Register')
@section('keywords', '')
@section('content')
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-up">
						<h3>Register Here</h3>
						<p class="creating">Having hands on experience in creating innovative designs,I do offer design 
							solutions which harness.</p>
						<h5>Personal Information</h5>
						<form method="POST" action="{{ route('register') }}">
							@if($errors->any())
								<div class="row collapse">
									<ul class="alert-box warning radius">
										@foreach($errors->all() as $error)
											<li> {{ $error }} </li>
										@endforeach
									</ul>
								</div>
							@endif
							{{ csrf_field() }}
							<div class="sign-u">
								<div class="sign-up1">
									<h4>First Name* :</h4>
								</div>
								<div class="sign-up2">
									<input id="first_name" name="first_name" type="text" value="{{old('first_name')}}" placeholder=" " required autofocus/>
									@if ($errors->has('first_name'))
										<span class="help-block">
											<strong>{{ $errors->first('first_name') }}</strong>
										</span>
									@endif
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="sign-u">
								<div class="sign-up1">
									<h4>Last Name* :</h4>
								</div>
								<div class="sign-up2">
									<input id="last_name" name="last_name" type="text" value="{{old('last_name')}}" placeholder=" " required/>
									@if ($errors->has('last_name'))
										<span class="help-block">
											<strong>{{ $errors->first('last_name') }}</strong>
										</span>
									@endif
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="sign-u">
								<div class="sign-up1">
									<h4>Email Address* :</h4>
								</div>
								<div class="sign-up2">
									<input id="email" name="email" type="text" value="{{old('email')}}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email address';}" required/>
									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
								<div class="clearfix"> </div>
							</div>
							<h6>Login Information</h6>
							<div class="sign-u">
								<div class="sign-up1">
									<h4>Password* :</h4>
								</div>
								<div class="sign-up2">
									<input id="password" type="password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required>
									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="sign-u">
								<div class="sign-up1">
									<h4>Confirm Password* :</h4>
								</div>
								<div class="sign-up2">
										<input id="password-confirm" type="password" name="password_confirmation" required>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="sub_home">
								<div class="sub_home_left">
										<input type="submit" value="Submit">
								</div>
								<div class="sub_home_right">
									<p>Already have an account?<a href="{{route('login')}}">Login</a></p>
								</div>
								<div class="clearfix"> </div>
							</div>
						</form>
					</div>
				</div>
			</div>
	@section('moreScripts')
	@endsection
@endsection