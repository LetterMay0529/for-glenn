@include('admin.content.login-header')

<header id="header">
	<div style="margin-top:25px;font-size:18pt;">ADMIN LOGIN</div>
</header>

<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">
			@if(session()->has('error'))
				<div class="alert alert-danger">
					{{ session()->get('error') }}
				</div>
			@endif
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
						<div>
							
							<img src="{{ asset('seekers_assets/assets/img/slide1/SCgif.gif') }}" class="pull-right display-image" alt="" style="width:800px;margin-top:30px;">

						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							<form action="{{ route('admin.loginshow') }}" id="login-form" class="smart-form client-form" method="POST">
							@csrf	
							<header>
									Sign In
								</header>

								<fieldset>
									
									<section>
									
										<label class="label">E-mail</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="email" name="email" value="{{ old('email') }}">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
									</section>

									<section>
										<label class="label">Password</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="password">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
										<div class="note">
											<a href="forgotpassword.html">Forgot password?</a>
										</div>
									</section>
								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">
										Sign in
									</button>
								</footer>
							</form>

						</div>
						 
						
					</div>
				</div>
			</div>

</div>
@include('admin.content.login-footer')