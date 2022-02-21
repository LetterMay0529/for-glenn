@include('admin.content.header')
@include('admin.content.sidebar')
<style>
.circular--landscape {
  display: inline-block;
  position: relative;
  width: 200px;
  height: 200px;
  overflow: hidden;
  border-radius: 50%;
}

.circular--landscape img {
  width: auto;
  height: 100%;
}
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
					<li>Admin</li><li>Profile Settings</li>
				</ol>


			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">


					<div class="row">
						<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
							<h1 class="page-title txt-color-blueDark">
								
								<!-- PAGE HEADER -->
								<i class="fa-fw fa fa-pencil-home-o"></i> 
									Admin
								<span>>  
                                    Profile Settings
								</span>
							</h1>
						</div>
					</div>

					<!-- widget grid -->
					<section id="widget-grid" class="">
						<!-- START ROW -->

						<div class="row">

							<!-- NEW COL START -->
							<article class="col-sm-12 col-md-12 col-lg-12">
															<!-- Widget ID (each widget will need unique ID)-->
							<div class="well well-light">
								 <div class="row">
                                     <div class="col col-md-4 bg-color-darken" style="padding: 20px;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-column align-items-center text-center " style="color:white;">
                                                <form method="POST" action="{{ route('admin.update_profile_img'); }}" enctype="multipart/form-data" id="form_profile_img">
                                                <?php 
                                                    
                                                    if(auth()->user()->profile_img == 'none'){
                                                            $img = asset('profile_img/avatar-agent.jpg');
                                                    }else{
                                                        $img = asset('profile_img/'.auth()->user()->profile_img);
                                                    }

                                                ?>        
                                                <div class="circular--landscape"><img src="<?php echo $img; ?>"  alt="Admin"  id="profilePreview" >
                                                        </div>
                                                        <div class="mt-3">
                                                        <h4><a href="javascript:void(0);" style="border-bottom: dashed 0px #08c; color: #FFFFFF;" class="edit" id="firstname" data-type="text" data-pk="1" data-original-title="Enter Firstname"><?php echo ucfirst(auth()->user()->firstname); ?></a> 
                                                        <a href="javascript:void(0);" style="border-bottom: dashed 0px #08c; color: #FFFFFF;"class="edit" id="lastname" data-type="text" data-pk="1" data-original-title="Enter Firstname"><?php echo ucfirst(auth()->user()->lastname); ?></a>
                                                        <i class="fa fa-pencil"  style="color: grey;"></i>
                                                        </h4>
                                                        <p class="text-secondary mb-1"><label class="label label-success">Admin</label></p>
                                                        <p class="text-muted font-size-sm"><a href="javascript:void(0);" style="border-bottom: dashed 0px #08c; color: #FFFFFF;" class="edit" id="email" data-type="text" data-pk="1" data-original-title="Enter Email"><?php echo auth()->user()->email; ?></a> <i class="fa fa-pencil"  style="color: grey;"></i></p>
                                                        <p class="text-muted font-size-sm">+63 <?php echo auth()->user()->phone; ?></p> 

                                                        <input type="file" name="profilePhoto" id="profilePhoto" style="display:none;">
                                                        <div class=" " style="text-align:center; margin-bottom: 10px;"> 
                                                            <input type="button" class="btn btn-sm btn-primary" value="Update Profile Photo" onclick="upload_profile_photo()"></br>
                                                        </div>
                                                        <div class=" " id="uploadProfilebtn" style="text-align:center;  margin-bottom: 10px; display:none; "> 
                                                            <input type="submit" class="btn btn-sm btn-success" value="Upload Profile Photo">
                                                        </div>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-md-8" >
                                        <div class="row">
                                            <div class="col-md-12">
                                            <h2>Change Password: </h2>
                                            <ul>
                                                <li>Must have a capital letter.</li>
                                                <li>Must contain a number</li>
                                                <li>Minimum of 6 digits charater.</li>
                                                <li>Must contain a punctuation.</li>
                                            </ul>
                                            <form id="password-form" class="smart-form" method="POST" action="{{ route('admin.change_password'); }}"> 
                                                    
                                                <fieldset>
                                                    <section>
                                                        <label class="input"> <i class="icon-append fa fa-key"></i>
                                                            <input type="password" name="password" id="password" placeholder="New Password">
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="input"> <i class="icon-append fa fa-key"></i>
                                                            <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm password">
                                                        </label>
                                                    </section>

                                                </fieldset>
                                                <footer>
                                                    <button type="submit" class="btn btn-primary" id="changePassBtn">
                                                        Change Password
                                                    </button>
                                                </footer>
                                            </form>	
                                            <div>
                                        </div>
                                    </div>
                                </div>
							</div>
							<!-- end widget -->
							</article>
							<!-- END COL -->		

						</div>

						<!-- END ROW -->

					</section>
					<!-- end widget grid -->

                    <!-- Modal -->
                <div class="modal fade" id="savePropModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-save"> </i> Properties Save by Customer</h4>
                            </div>
                        
                            <div class="modal-body" id="savePropModalbody">
                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Close
                                </button> 
                            </div> 
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal --> 
					</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->
		
@include('admin.content.footer-new.footer-js-new')
<!-- CUSTOM NOTIFICATION -->
<script src="{{ asset('admin_assets/js/notification/SmartNotification.min.js'); }}"></script>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/x-editable/moment.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/x-editable/jquery.mockjax.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/x-editable/x-editable.min.js') }}"></script>
<script>

    var $changePassword = $("#password-form").validate({
	
    // Rules for form validation
    rules : {
        
        password : {
            required : true,
            minlength : 3, 
            maxlength : 20
        },
        passwordConfirm : {
            required : true,
            minlength : 3,
            maxlength : 20,
            equalTo : '#password'
        }
    },

    // Messages for form validation
    messages : {
        
        password : {
            required : '<p style="color:red;">Please enter your password!</p>'
        },
        passwordConfirm : {
            required : '<p style="color:red;">Please enter your password one more time!</p>',
            equalTo : '<p style="color:red;">Please enter the same password as above!</p>'
        }
    },
    submitHandler : function(form){

                $(form).ajaxSubmit({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    beforeSend: function() { 
                        document.getElementById('changePassBtn').value = 'Submitting ...';  
                        $('#changePassBtn').prop('disabled', true);
                    },
                    success : function(res) {

                        document.getElementById('changePassBtn').value = 'Submit';  
                        $('#changePassBtn').prop('disabled', false);

                        if(res == 'SUCCESS'){

                            $.smallBox({
                                title : "Password updated!",
                                content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
                                color : "#739E73",
                                iconSmall : "fa fa-key bounce animated",
                                timeout : 4000
                            });

                        }else if(res == 'FAILED'){
                            
                            $.smallBox({
                                title : "FAILED!!",
                                content : "QUERY to database failed!",
                                color : "#C46A69",
                                iconSmall : "fa fa-times bounce animated",
                                timeout : 4000
                            });
                            
                        }else{
                            var json = $.parseJSON(res);
                            //console.log(json.length);
                            var contents='';

                            $.each(json, function(index, element) {
                                //console.log(element);
                                $.each(element, function(index2, element2) {
                                    contents = contents+'<li>'+element2+'</li>';
                                });
                                
                            });
                            
                            $.smallBox({
                                title : "Posting property error",
                                content : contents,
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

//=============== UPDATE EMAIL X-EDITABLE ====================
$('#email').editable({
            url: "{{ route('admin.update_user_details'); }}", 
            type: 'text',
            title: 'Edit category', 
            ajaxOptions: {
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                // data: {"_token": "{{ csrf_token() }}"},
            },
             success: function(data) { 
              if(data == 'success'){

                $.smallBox({
                    title : "Data sucessfully updated",
                    content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
                    color : "#739E73",
                    iconSmall : "fa fa-check bounce animated",
                    timeout : 4000
                });

              }else{
                $.smallBox({
                    title : "FAILED!",
                    content : data,
                    color : "#C46A69",
                    iconSmall : "fa fa-times bounce animated",
                    timeout : 4000
                });
              }

            }, 
        });
//=============== UPDATE Firstname X-EDITABLE ====================
$('#firstname').editable({
            url: "{{ route('admin.update_user_details'); }}", 
            type: 'text',
            title: 'Edit category', 
            ajaxOptions: {
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                // data: {"_token": "{{ csrf_token() }}"},
            },
             success: function(data) { 
              if(data == 'success'){

                $.smallBox({
                    title : "Data sucessfully updated",
                    content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
                    color : "#739E73",
                    iconSmall : "fa fa-check bounce animated",
                    timeout : 4000
                });

              }else{
                $.smallBox({
                    title : "FAILED!",
                    content : data,
                    color : "#C46A69",
                    iconSmall : "fa fa-times bounce animated",
                    timeout : 4000
                });
              }

            }, 
        });

//=============== UPDATE lastname X-EDITABLE ====================
$('#lastname').editable({
            url: "{{ route('admin.update_user_details'); }}", 
            type: 'text',
            title: 'Edit category', 
            ajaxOptions: {
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                // data: {"_token": "{{ csrf_token() }}"},
            },
             success: function(data) { 
              if(data == 'success'){

                $.smallBox({
                    title : "Data sucessfully updated",
                    content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
                    color : "#739E73",
                    iconSmall : "fa fa-check bounce animated",
                    timeout : 4000
                });

              }else{
                $.smallBox({
                    title : "FAILED!",
                    content : data,
                    color : "#C46A69",
                    iconSmall : "fa fa-times bounce animated",
                    timeout : 4000
                });
              }

            }, 
        });

function upload_profile_photo(){

    $('#profilePhoto').click();

}

$('input[name=profilePhoto]').on('change',function(){

    //console.log(this.value);
    if(this.value == null || this.value == ''){

        $('#uploadProfilebtn').show('false');

    }else{

        $('#uploadProfilebtn').show('true');

    }

});

$('#form_profile_img').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
 
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){

                $.smallBox({
                    title : "Admin new profile image sucessfully uploaded",
                    content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
                    color : "#739E73",
                    iconSmall : "fa fa-check bounce animated",
                    timeout : 4000
                });

                $('#uploadProfilebtn').hide();
                console.log(data);
            },
            error: function(data){
                $.smallBox({
                    title : "FAILED!",
                    content : 'Image upload error',
                    color : "#C46A69",
                    iconSmall : "fa fa-times bounce animated",
                    timeout : 4000
                });
            }
        });

    }));

        profilePhoto.onchange = evt => {
                const [file] = profilePhoto.files
        
                if (file) {
                    profilePreview.src = URL.createObjectURL(file)
                }
            }
</script> 
@include('admin.content.footer-new.footer-last-new')