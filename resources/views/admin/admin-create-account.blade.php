@include('admin.content.header')
@include('admin.content.sidebar') 
<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment"> 
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span> 
				</span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li>Admin</li><li>Admin Create Account</li>
				</ol>
				<!-- end breadcrumb -->
			</div>
			<!-- END RIBBON -->
            <!-- MAIN CONTENT -->
            <div id="content">

                <!-- row -->
                <div class="row">
						<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
							<h1 class="page-title txt-color-blueDark">
								
								<!-- PAGE HEADER -->
								<i class="fa-fw fa fa-pencil-home-o"></i> 
									Admin
								<span>>  
                                    Admin Create Account
								</span>
							</h1>
						</div>
					</div>

                <div class="row">
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
                     <div class="well well-light">
                     <form action="{{ route('admin.sign_up_admin') }}" method="POST" id="create_admin_account" class="smart-form client-form">
							 @csrf	

								<fieldset>

								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="firstname" style="text-transform: capitalize;" placeholder="First name" value="{{ old('firstname');}}">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="middlename" style="text-transform: capitalize;" placeholder="Middle name" value="{{ old('middlename');}}">
										</label>
									</section>
								</div>
								<div class="row">
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="lastname" style="text-transform: capitalize;" placeholder="Last name" value="{{ old('lastname');}}">
										</label>
									</section>
									<section class="col col-6">
										<label class="input"> <i class="icon-prepend fa fa-user"></i>
											<input type="text" name="suffix" placeholder="Suffix" style="text-transform: capitalize;" value="{{ old('suffix');}}">
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
												<input type="text" name="date_of_birth" value="{{ old('date_of_birth');}}" placeholder="Date of Birth" class="datepicker" data-dateformat='dd/mm/yy' readonly=''>
											</label>
										</section>
									</div>
								</fieldset>
								<fieldset>
                                    <section>
                                        <div class="input">
                                            <p style="font-style:italic;">Note: Please make sure choose a strong password. </p></br>
                                            <ul>
                                                <li>Must have a capital letter.</li>
                                                <li>Must contain a number</li>
                                                <li>Minimum of 6 digits charater.</li>
                                                <li>Must contain a punctuation.</li>
                                            </ul>
                                        </div>
                                    </section>
                                    <br>
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

								<fieldset>

								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">
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
                
                </div>
                
                <!-- end row -->

            </div>
</div>
<!-- END MAIN CONTENT -->

@include('admin.content.footer-new.footer-js-new')
<!-- JQUERY VALIDATE -->
<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>

<!-- JQUERY MASKED INPUT -->
<script src="{{ asset('admin_assets/js/plugin/masked-input/jquery.maskedinput.min.js') }}"></script>

<script>
    $(function() {
        var $createForm = $('#create_admin_account').validate({
			// Rules for form validation
				rules : {
					firstname : {
						required : true
					},
					middlename : {
						required : true
					},
                    lastname : {
						required : true
					},
					email : {
						required : true,
						email : true
					},
					phone : {
						required : true
					}, 
					gender : {
						required : true
					},
					date_of_birth : {
						required : true
					},
					username : {
						required : true
					},
					password : {
						required : true,
						minlength : 6,
						maxlength : 20
					},
					passwordConfirm : {
						required : true,
						minlength : 6,
						maxlength : 20,
						equalTo : '#password'
					}
				},
		
				// Messages for form validation
				messages : {
					firstname : {
						required : '<p style="color:red">Please enter your first name</p>'
					},
                    middlename : {
						required : '<p style="color:red">Please enter your middle name</p>'
					},
					lastname : {
						required : '<p style="color:red">Please enter your last name</p>'
					},
					email : {
						required : '<p style="color:red">Please enter your email address</p>',
						email : '<p style="color:red">Please enter a VALID email address</p>'
					},
					phone : {
						required : '<p style="color:red">Please enter your phone number</p>'
					},
					gender : {
						required : '<p style="color:red">Please select your gender</p>'
					},
					date_of_birth : {
						required : '<p style="color:red">Date of birth is necessary</p>'
					},
					code : {
						required : '<p style="color:red">Please enter code</p>',
						digits : '<p style="color:red">Digits only please</p>'
					},
					username : {
						required : '<p style="color:red">Please enter username'
					},
					password : {
						required : '<p style="color:red">Please enter name on your password</p>',
                        minlength : '<p style="color:red">Minimum character for password is 6</p>',
						maxlength : '<p style="color:red">Minimum character for password is 20</p>'
					},
					passwordConfirm : {
						required : '<p style="color:red">Please enter name on your password</p>',
                        minlength : '<p style="color:red">Minimum character for password is 6</p>',
						maxlength : '<p style="color:red">Minimum character for password is 20</p>',
                        equalTo : '<p style="color:red">Password didn\'t match</p>'
					}
				},
		
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
    });
</script>
@include('admin.content.footer-new.footer-last-new')