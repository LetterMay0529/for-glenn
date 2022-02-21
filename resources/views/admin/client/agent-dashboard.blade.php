@include('admin.content.header')
@include('admin.content.sidebar')

<style>
	.link:hover {text-decoration:underline;}
</style>

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
					<li>Agent</li><li>Dashboard</li>
				</ol>
				<!-- end breadcrumb -->
			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">


					<div class="row">
						<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
							<h1 class="page-title txt-color-blueDark">
								
								<!-- PAGE HEADER -->
								<i class="fa-fw fa fa-pencil-home-o"></i> 
									Agent
								<span>>  
									Dashboard
								</span>
							</h1>
						</div>
						
					</div>


					@if(session()->has('success'))
						<div class="alert alert-block alert-success">
							<a class="close" data-dismiss="alert" href="#">×</a>
							<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> {{ session()->get('title') }}</h4>
							<p>
								{{ session()->get('success') }}
							</p>
						</div>
					@endif
					
					@if(session()->has('error'))
						<div class="alert alert-danger">
							{{ session()->get('error') }}
						</div>
					@endif
					

					<!-- widget grid -->
					<section id="widget-grid" class="">
						<!-- START ROW -->

						<div class="row">

							<!-- NEW COL START -->
							<article class="col-sm-12 col-md-12 col-lg-12">
								<div class="well well-sm well-light">
									@if(auth()->user()->date_verified_at == NULL)
										<div class="alert alert-block alert-danger">
											<a class="close" data-dismiss="alert" href="#">×</a>
											<h4 class="alert-heading"><i class="fa fa-user"></i> Account not verified</h4>
											Submit account details to verify account. </br>
											 
										</div>
									@endif
 
									<!-- @if(auth()->user()->phone_verified_at == NULL)
										<div class="alert alert-block alert-warning">
											<a class="close" data-dismiss="alert" href="#">×</a>
											<h4 class="alert-heading"><i class="fa fa-phone"></i> Phone not verified yet</h4>
											Please verify your phone number <?php echo '+'.auth()->user()->phone; ?>. <a href="javascript:void(0)"class="link">Send verification code to phone.</a>
										</div>
									@endif -->
									<!-- @if(auth()->user()->profile_img == 'none')
										<div class="alert alert-block alert-warning">
											<a class="close" data-dismiss="alert" href="#">×</a>
											<h4 class="alert-heading"><i class="fa fa-file-image-o"></i> No profile picture uploaded</h4>
											</br> Please provide picture for legitimacy. </br>
											<ul>
												<li>Should show full face</li>
												<li>Does not have filter.</li>
											</ul> </br>
											<form class="smart-form" method="POST" enctype="multipart/form-data" action = "{{ route('upload_profile_img'); }}"	>
											@csrf
												<div>
													<section >
														<div class="input input-file">
															<span class="button">
																<input type="file" id="profile_img" name="profile_img" accept="image/x-png,image/gif,image/jpeg"  onchange="this.parentNode.nextSibling.value = this.value" class="input-sm">Browse</span>
																<input type="text" placeholder="Include some files" readonly="">
														</div>
													</section>
												</div>
												<input type="submit" class="btn btn-primary btn-sm" value="Upload photo">
											</form>
										</div>
									@endif -->
								</div>						
							</article>
							<!-- END COL -->		

						</div>

						<!-- END ROW -->

					</section>
					<!-- end widget grid -->
					</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->
<script>
	if (!window.jQuery) {
		document.write('<script src="{{ asset('admin_assets/js/libs/jquery-2.1.1.min.js'); }} "><\/script>');
	}
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
	if (!window.jQuery.ui) {
		document.write('<script src="{{ asset('admin_assets/js/libs/jquery-ui-1.10.3.min.js'); }} "><\/script>');
	}
</script>
<!-- CUSTOM NOTIFICATION -->
<script src="{{ asset('admin_assets/js/notification/SmartNotification.min.js'); }}"></script>
		<!-- JQUERY VALIDATE -->
		<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>
<script>


// function send_code(){
// 		$.SmartMessageBox({
// 			title : "Verify Email",
// 			content : "Please click \'YES\' to send verification to email!",
// 			buttons : '[No][Yes]'
// 		}, function(ButtonPressed) {
// 			if (ButtonPressed === "Yes") {

// 				$.ajax({
// 					"url" : "{{ route('agent.agent_verify_email'); }}",
// 					"headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
// 					"method" : "POST", 
// 					"beforeSend": function(){
// 						$('#verify_email_div').html('<img style="width: 30px;"  src="{{ asset("admin_assets/img/loading/spinner.svg"); }}">');
// 					},
// 					"success": function(data){
						
// 						if(data != 'FAILED'){
						
						
// 							$('#verify_email_div').html(data);

// 						}else{
// 							$.smallBox({
// 								title : "ERROR",
// 								content : data,
// 								color : "#659265",
// 								iconSmall : "fa fa-times fa-2x fadeInRight animated",
// 								timeout : 4000
// 							});

// 							$('#verify_email_div').html('<a href="javascript:void(0)" class="link" onclick="send_code()">Send verification code to email.</a>');
// 						}
						
// 					}

// 				}); 
// 			}

// 		});
// 	//e.preventDefault();
// }
</script>
@include('admin.content.footer')

