@extends('layouts.auth')
@section('title', 'Login')
@section('keywords', '')
@section('content')
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<p><span>Sign In to</span> <a href="index.html">{{config('app.name')}}</a></p>
						</div>
						<div class="signin">
							<form class="form-horizontal" method="POST" action="{{ route('login') }}">
								 {{ csrf_field() }}
							<div class="log-input form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<div class="log-input-left ">
								   <input type="text" id="email" type="email" class="form-control user" name="email" value="{{ old('email') }}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email address';}" required autofocus />
								</div>
								<!-- <span class="checkbox2">
									 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i></label>
								</span> -->
								<div class="clearfix"> </div>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
							<div class="log-input form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<div class="log-input-left">
								   <input type="password" id="password"  class="form-control lock" name="password" placeholder="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required/>
								</div>
								<!-- <span class="checkbox2">
									 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i></label>
								</span> -->
								<div class="clearfix"> </div>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                                <div class="log-input form-group col-md-12">
                                    <div class="log-input-left">
                                        <div class="checkbox1">
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Remember Me
                                        </div>
                                    </div>
                                </div>
							<div class="log-input form-group">
								<div class="log-input-left">
									<input type="submit" class="submit" value="Login to your account">
								</div>
							</div>
						</form>
						<div class="log-input">
							<p class="checkbox1"><a href="{{ route('password.request') }}">Forgot Password</a> </p>
							<div class="clearfix"> </div>
						</div>
						</div>
						<div class="new_people">
							<h4>For New People</h4>
							<p>Having hands on experience in creating innovative designs,I do offer design
								solutions which harness.</p>
							<a href="{{route('register')}}">Register Now!</a>
						</div>
					</div>
				</div>
			</div>
	@section('moreScripts')
	@endsection
@endsection