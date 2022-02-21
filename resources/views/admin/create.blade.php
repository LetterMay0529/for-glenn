@include('admin.content.login-header')
<header id="header">

<div id="logo-group">
	<span id="logo"> <a href="{{ route('home');}}"><img src="{{ asset('seekers_assets/assets/img/slide1/logosc.png');}}" alt="" style="width: 180px;margin-top:5px;" ></a> </span>
</div>

<span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Already have an account?</span> <a href="{{ route('seeker.login'); }}" class="btn btn-primary">Sign In</a> </span>

</header>

<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">
					@if($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@if(session()->has('success'))
						<div class="alert alert-block alert-success">
							<a class="close" data-dismiss="alert" href="#">×</a>
							<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> {{ session()->get('title') }}</h4>
							<p>
								{{ session()->get('success') }}
							</p>
						</div>
					@endif
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
						<div class="well no-padding">

							<form action="{{ route('sign_up_admin') }}" method="POST" id="smart-form-register" class="smart-form client-form">
							 @csrf	
							<header>
									Create an Account
								</header>

								<fieldset>

								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="firstname" placeholder="First name" value="{{ old('firstname');}}">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="middlename" placeholder="Middle name" value="{{ old('middlename');}}">
										</label>
									</section>
								</div>
								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="lastname" placeholder="Last name" value="{{ old('lastname');}}">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="suffix" placeholder="Suffix" value="{{ old('suffix');}}">
										</label>
									</section>
								</div>
								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>
											<input type="email" name="email" placeholder="E-mail" value="{{ old('email');}}">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-phone"></i>
											<input type="tel" name="phone" value="{{ old('phone'); }}" placeholder="Phone" data-mask="(999) 999-9999">
										</label>
									</section>
								</div>
								</fieldset>

								<fieldset>
									<div class="row">
										<section class="col col-6">
											<label class="select">
												<select name="gender" value="{{ old('gender');}}">
													<option value="0" selected="" disabled="">Gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select> <i></i> </label>
										</section>
										<section class="col col-6">
											<label class="input"> <i class="icon-append fa fa-calendar"></i>
												<input type="text" name="date_of_birth" value="{{ old('date_of_birth');}}" placeholder="Date of Birth" class="datepicker" data-dateformat='dd/mm/yy'>
											</label>
										</section>
									</div>
								</fieldset>
								<fieldset>
									<section>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="username" value="{{ old('username');}}" placeholder="Username">
											<b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
									</section>

									<section>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="password" placeholder="Password" id="password">
											<b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
									</section>

									<section>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="passwordConfirm" placeholder="Confirm password">
											<b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
									</section>
								</fieldset>

								<!-- <fieldset>

									<section>
										<label class="checkbox">
											<input type="checkbox" name="subscription" id="subscription">
											<i></i>I want to receive news and special offers</label>
										<label class="checkbox">
											<input type="checkbox" name="terms" id="terms">
											<i></i>I agree with the <a href="#" data-toggle="modal" data-target="#myModal"> Terms and Conditions </a></label>
									</section>
								</fieldset> -->
								<footer>
									<button type="submit" class="btn btn-warning">
										Register
									</button>
								</footer>

								<div class="message">
									<i class="fa fa-check"></i>
									<p>
										Thank you for your registration!
									</p>
								</div>
							</form>

						</div>
						<p class="note text-center">REAL ESTATE APPLICATION 2021.</p>
					</div>
				</div>
			</div>

		</div>
    
@include('admin.content.login-footer')