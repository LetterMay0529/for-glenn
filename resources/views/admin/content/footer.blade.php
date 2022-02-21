
		<!-- PAGE FOOTER -->
		<div class="page-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<span class="txt-color-white">Real Estate Portal v1 © 2021-Present</span>
				</div>
			</div>
		</div>
		<!-- END PAGE FOOTER -->

	 
		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="{{ asset('admin_assets/js/plugin/pace/pace.min.js') }}"></script>

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="{{ asset('admin_assets/js/libs/jquery-2.1.1.min.js') }}"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="{{ asset('admin_assets/js/libs/jquery-ui-1.10.3.min.js') }}"><\/script>');
			}
		</script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="{{ asset('admin_assets/js/app.config.js') }}"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="{{ asset('admin_assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') }}"></script> 

		<!-- BOOTSTRAP JS -->
		<script src="{{ asset('admin_assets/js/bootstrap/bootstrap.min.js') }}"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="{{ asset('admin_assets/js/notification/SmartNotification.min.js') }}"></script>

		<!-- JARVIS WIDGETS -->
		<script src="{{ asset('admin_assets/js/smartwidgets/jarvis.widget.min.js') }}"></script>

		<!-- EASY PIE CHARTS -->
		<script src="{{ asset('admin_assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js') }}"></script>

		<!-- SPARKLINES -->
		<script src="{{ asset('admin_assets/js/plugin/sparkline/jquery.sparkline.min.js') }}"></script>

		<!-- JQUERY VALIDATE -->
		<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="{{ asset('admin_assets/js/plugin/masked-input/jquery.maskedinput.min.js') }}"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<!-- <script src="{{ asset('admin_assets/js/plugin/select2/select2.min.js') }}"></script> -->

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="{{ asset('admin_assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js') }}"></script>

		<!-- browser msie issue fix -->
		<script src="{{ asset('admin_assets/js/plugin/msie-fix/jquery.mb.browser.min.js') }}"></script>

		<!-- FastClick: For mobile devices -->
		<script src="{{ asset('admin_assets/js/plugin/fastclick/fastclick.min.js') }}"></script>

		<!--[if IE 8]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

		<!-- Demo purpose only -->
		<script src="{{ asset('admin_assets/js/demo.min.js') }}"></script>

		<!-- MAIN APP JS FILE -->
		<script src="{{ asset('admin_assets/js/app.min.js') }}"></script>

		<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
		<!-- Voice command : plugin -->
		<script src="{{ asset('admin_assets/js/speech/voicecommand.min.js') }}"></script>

		<!-- SmartChat UI : plugin -->
		<script src="{{ asset('admin_assets/js/smart-chat-ui/smart.chat.ui.min.js') }}"></script>
		<script src="{{ asset('admin_assets/js/smart-chat-ui/smart.chat.manager.min.js') }}"></script>

		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="{{ asset('admin_assets/js/plugin/jquery-form/jquery-form.min.js') }}"></script>
		

		<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();

			// var $checkoutForm = $('#checkout-form').validate({
			// // Rules for form validation
			// 	rules : {
			// 		fname : {
			// 			required : true
			// 		},
			// 		lname : {
			// 			required : true
			// 		},
			// 		email : {
			// 			required : true,
			// 			email : true
			// 		},
			// 		phone : {
			// 			required : true
			// 		},
			// 		country : {
			// 			required : true
			// 		},
			// 		city : {
			// 			required : true
			// 		},
			// 		code : {
			// 			required : true,
			// 			digits : true
			// 		},
			// 		address : {
			// 			required : true
			// 		},
			// 		name : {
			// 			required : true
			// 		},
			// 		card : {
			// 			required : true,
			// 			creditcard : true
			// 		},
			// 		cvv : {
			// 			required : true,
			// 			digits : true
			// 		},
			// 		month : {
			// 			required : true
			// 		},
			// 		year : {
			// 			required : true,
			// 			digits : true
			// 		}
			// 	},
		
			// 	// Messages for form validation
			// 	messages : {
			// 		fname : {
			// 			required : 'Please enter your first name'
			// 		},
			// 		lname : {
			// 			required : 'Please enter your last name'
			// 		},
			// 		email : {
			// 			required : 'Please enter your email address',
			// 			email : 'Please enter a VALID email address'
			// 		},
			// 		phone : {
			// 			required : 'Please enter your phone number'
			// 		},
			// 		country : {
			// 			required : 'Please select your country'
			// 		},
			// 		city : {
			// 			required : 'Please enter your city'
			// 		},
			// 		code : {
			// 			required : 'Please enter code',
			// 			digits : 'Digits only please'
			// 		},
			// 		address : {
			// 			required : 'Please enter your full address'
			// 		},
			// 		name : {
			// 			required : 'Please enter name on your card'
			// 		},
			// 		card : {
			// 			required : 'Please enter your card number'
			// 		},
			// 		cvv : {
			// 			required : 'Enter CVV2',
			// 			digits : 'Digits only'
			// 		},
			// 		month : {
			// 			required : 'Select month'
			// 		},
			// 		year : {
			// 			required : 'Enter year',
			// 			digits : 'Digits only please'
			// 		}
			// 	},
		
			// 	// Do not change code below
			// 	errorPlacement : function(error, element) {
			// 		error.insertAfter(element.parent());
			// 	}
			// });
					
			// var $registerForm = $("#smart-form-register").validate({
	
			// 	// Rules for form validation
			// 	rules : {
			// 		username : {
			// 			required : true
			// 		},
			// 		email : {
			// 			required : true,
			// 			email : true
			// 		},
			// 		password : {
			// 			required : true,
			// 			minlength : 3,
			// 			maxlength : 20
			// 		},
			// 		passwordConfirm : {
			// 			required : true,
			// 			minlength : 3,
			// 			maxlength : 20,
			// 			equalTo : '#password'
			// 		},
			// 		firstname : {
			// 			required : true
			// 		},
			// 		lastname : {
			// 			required : true
			// 		},
			// 		gender : {
			// 			required : true
			// 		},
			// 		terms : {
			// 			required : true
			// 		}
			// 	},
	
			// 	// Messages for form validation
			// 	messages : {
			// 		login : {
			// 			required : 'Please enter your login'
			// 		},
			// 		email : {
			// 			required : 'Please enter your email address',
			// 			email : 'Please enter a VALID email address'
			// 		},
			// 		password : {
			// 			required : 'Please enter your password'
			// 		},
			// 		passwordConfirm : {
			// 			required : 'Please enter your password one more time',
			// 			equalTo : 'Please enter the same password as above'
			// 		},
			// 		firstname : {
			// 			required : 'Please select your first name'
			// 		},
			// 		lastname : {
			// 			required : 'Please select your last name'
			// 		},
			// 		gender : {
			// 			required : 'Please select your gender'
			// 		},
			// 		terms : {
			// 			required : 'You must agree with Terms and Conditions'
			// 		}
			// 	},
	
			// 	// Do not change code below
			// 	errorPlacement : function(error, element) {
			// 		error.insertAfter(element.parent());
			// 	}
			// });
	
			// var $reviewForm = $("#review-form").validate({
			// 	// Rules for form validation
			// 	rules : {
			// 		name : {
			// 			required : true
			// 		},
			// 		email : {
			// 			required : true,
			// 			email : true
			// 		},
			// 		review : {
			// 			required : true,
			// 			minlength : 20
			// 		},
			// 		quality : {
			// 			required : true
			// 		},
			// 		reliability : {
			// 			required : true
			// 		},
			// 		overall : {
			// 			required : true
			// 		}
			// 	},
	
			// 	// Messages for form validation
			// 	messages : {
			// 		name : {
			// 			required : 'Please enter your name'
			// 		},
			// 		email : {
			// 			required : 'Please enter your email address',
			// 			email : '<i class="fa fa-warning"></i><strong>Please enter a VALID email addres</strong>'
			// 		},
			// 		review : {
			// 			required : 'Please enter your review'
			// 		},
			// 		quality : {
			// 			required : 'Please rate quality of the product'
			// 		},
			// 		reliability : {
			// 			required : 'Please rate reliability of the product'
			// 		},
			// 		overall : {
			// 			required : 'Please rate the product'
			// 		}
			// 	},
	
			// 	// Do not change code below
			// 	errorPlacement : function(error, element) {
			// 		error.insertAfter(element.parent());
			// 	}
			// });
			
			// var $commentForm = $("#comment-form").validate({
			// 	// Rules for form validation
			// 	rules : {
			// 		name : {
			// 			required : true
			// 		},
			// 		email : {
			// 			required : true,
			// 			email : true
			// 		},
			// 		url : {
			// 			url : true
			// 		},
			// 		comment : {
			// 			required : true
			// 		}
			// 	},
	
			// 	// Messages for form validation
			// 	messages : {
			// 		name : {
			// 			required : 'Enter your name',
			// 		},
			// 		email : {
			// 			required : 'Enter your email address',
			// 			email : 'Enter a VALID email'
			// 		},
			// 		url : {
			// 			email : 'Enter a VALID url'
			// 		},
			// 		comment : {
			// 			required : 'Please enter your comment'
			// 		}
			// 	},
	
			// 	// Ajax form submition
			// 	submitHandler : function(form) {
			// 		$(form).ajaxSubmit({
			// 			success : function() {
			// 				$("#comment-form").addClass('submited');
			// 			}
			// 		});
			// 	},
	
			// 	// Do not change code below
			// 	errorPlacement : function(error, element) {
			// 		error.insertAfter(element.parent());
			// 	}
			// });
	
			// var $contactForm = $("#contact-form").validate({
			// 	// Rules for form validation
			// 	rules : {
			// 		name : {
			// 			required : true
			// 		},
			// 		email : {
			// 			required : true,
			// 			email : true
			// 		},
			// 		message : {
			// 			required : true,
			// 			minlength : 10
			// 		}
			// 	},
	
			// 	// Messages for form validation
			// 	messages : {
			// 		name : {
			// 			required : 'Please enter your name',
			// 		},
			// 		email : {
			// 			required : 'Please enter your email address',
			// 			email : 'Please enter a VALID email address'
			// 		},
			// 		message : {
			// 			required : 'Please enter your message'
			// 		}
			// 	},
	
			// 	// Ajax form submition
			// 	submitHandler : function(form) {
			// 		$(form).ajaxSubmit({
			// 			success : function() {
			// 				$("#contact-form").addClass('submited');
			// 			}
			// 		});
			// 	},
	
			// 	// Do not change code below
			// 	errorPlacement : function(error, element) {
			// 		error.insertAfter(element.parent());
			// 	}
			// });
	
			var $loginForm = $("#login-form").validate({
				// Rules for form validation
				rules : {
					email : {
						required : true,
						email : true
					},
					password : {
						required : true,
						minlength : 3,
						maxlength : 20
					}
				},
	
				// Messages for form validation
				messages : {
					email : {
						required : 'Please enter your email address',
						email : 'Please enter a VALID email address'
					},
					password : {
						required : 'Please enter your password'
					}
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
	
			var $orderForm = $("#order-form").validate({
				// Rules for form validation
				rules : {
					name : {
						required : true
					},
					email : {
						required : true,
						email : true
					},
					phone : {
						required : true
					},
					interested : {
						required : true
					},
					budget : {
						required : true
					}
				},
	
				// Messages for form validation
				messages : {
					name : {
						required : 'Please enter your name'
					},
					email : {
						required : 'Please enter your email address',
						email : 'Please enter a VALID email address'
					},
					phone : {
						required : 'Please enter your phone number'
					},
					interested : {
						required : 'Please select interested service'
					},
					budget : {
						required : 'Please select your budget'
					}
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
	
			// START AND FINISH DATE
			$('#startdate').datepicker({
				dateFormat : 'dd.mm.yy',
				prevText : '<i class="fa fa-chevron-left"></i>',
				nextText : '<i class="fa fa-chevron-right"></i>',
				onSelect : function(selectedDate) {
					$('#finishdate').datepicker('option', 'minDate', selectedDate);
				}
			});
			
			$('#finishdate').datepicker({
				dateFormat : 'dd.mm.yy',
				prevText : '<i class="fa fa-chevron-left"></i>',
				nextText : '<i class="fa fa-chevron-right"></i>',
				onSelect : function(selectedDate) {
					$('#startdate').datepicker('option', 'maxDate', selectedDate);
				}
			});


		
		})

		</script>

		<script>

			$('#activity').on('click', function(){
				
				console.log('dsfsd');
				$('#notificationBody').html('<center><p>Loading...</p><center>');

				$.ajax({
					url: "{{ route('agent.agent_view_notification'); }}",
					method: "POST",
					cache: false,
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					success: function(data){

						$('#notificationBody').html(data);

					}
				});
			});

		</script>
		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<script type="text/javascript">
			// var _gaq = _gaq || [];
			// 	_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
			// 	_gaq.push(['_trackPageview']);
			
			// (function() {
			// 	var ga = document.createElement('script');
			// 	ga.type = 'text/javascript';
			// 	ga.async = true;
			// 	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			// 	var s = document.getElementsByTagName('script')[0];
			// 	s.parentNode.insertBefore(ga, s);
			// })();

		</script>
		<?php if(auth()->user()->rank == '1'){?>
 		<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="8914cddc-b144-4a78-87dd-5e99725c9665";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
		<?php } ?>
	</body>

</html>