<div class="alert alert-success fade in">
<button class="close" data-dismiss="alert">×</button>
    <i class="fa-fw fa fa-check"></i><strong>Sent!</strong>
        Pincode was successfully sent. Please check email! The code will expire after 5 minutes.
</div>

<form class="form-inline" id="form_verify_code" class="" action="{{ route('agent.verify_pin_received') }}" method="POST">
@csrf
    <fieldset>
        <div class="form-group" style="margin-bottom:10px;">
            <input type="text" class="form-control" required name="pincode" placeholder="PINCODE">
        </div>
       
        <div>
            <input type="submit" id="email_ver_btn" value="Verify"class="btn btn-default btn-sm">
            <button type="button" onclick="send_code()" class="btn btn-default btn-sm">
            <i class="glyphicon glyphicon-refresh"></i> Resend Code</button>
        </diV>
        
    </fieldset>
</form>

<script>
    $(document).ready(function(){
		
	
		var $form_verify_code = $("#form_verify_code").validate({
				
				// Rules for form validation
				rules : {
					pincode : {
						required : true,
						number: true
					}
				},

				// Messages for form validation
				messages : {
					pincode : {
						required : '<p style="color:red">Please enter pincode</p>',
						number: '<p style="color:red">Please enter a valid number</p>'
					}
				},
				// Ajax form submition
					submitHandler : function(form) {
						$(form).ajaxSubmit({
							beforeSend: function() { 
								document.getElementById('email_ver_btn').value = 'Submitting ...';  
								$('#email_ver_btn').prop('disabled', true);
							},
							success : function(res) {

								document.getElementById('email_ver_btn').value = 'Add property';  
								$('#email_ver_btn').prop('disabled', false);

								if(res == 'SUCCESS'){
                                    $('#email_div').fadeOut('slow');
									$.smallBox({
											title : "Email successfully verified",
											content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
											color : "#739E73",
											iconSmall : "fa fa-check bounce animated",
											timeout : 4000
										});
								}else{

									$.smallBox({
										title : "Posting property error",
										content : res,
										color : "#C46A69",
										iconSmall : "fa fa-times bounce animated",
										timeout : 4000
									});
								}
								
							}
						});
					},

				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
	});
</script>