@include('admin.content.header')
@include('admin.content.sidebar')
<style>
.profile-pic1 > img {
    border-radius: 0;
    position: relative;
    border: 5px solid #fff;
    top: -50px;
    left: 10px;
    display: inline-block;
    text-align: right;
    z-index: 4;
    width: 100%;
    margin-bottom: -40px;
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
					<li>Agent</li><li>Profile</li>
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
									Profile
								</span>
							</h1>
						</div>
						
					</div>
                    <?php if(auth()->user()->date_verified_at == NULL){ ?>
                   
					<div class="alert alert-danger alert-block">
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">Account not verified yet!</h4>
                        
                        <p class="text-align-left">
                            <br>
                            <a href="javascript:void(0);" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"><strong>Click to request for verification</strong></a>
                        </p>
                    </div>
                    <?php } ?>
 

                    @if(auth()->user()->email_verified_at == NULL)
                        <div class="alert alert-block alert-warning" id="email_div">
                            <a class="close" data-dismiss="alert" href="#">×</a>
                            <h4 class="alert-heading"><i class="fa fa-envelope"></i> Email not verified yet</h4>
                            Please verify your email.
                            <div id="verify_email_div"><a href="javascript:void(0)" class="link" onclick="send_code()">Send verification code to email.</a></div>
                    </div>
                    @endif
					<!-- widget grid -->
					<section id="widget-grid" class="">
						<!-- START ROW -->

						<div class="row">

							<!-- NEW COL START -->
							<article class="col-sm-7 col-md-7 col-lg-7">
                                <div class="well well-light">
                                <div class="row no-padding">
				
                                    <div class="col-sm-12">
                                        <div id="myCarousel" class="carousel fade profile-carousel">
                                            <div class="air air-bottom-right padding-10">
                                                <a href="javascript:void(0);" id="enable" class="btn txt-color-white bg-color-teal btn-sm"><i class="fa fa-edit"></i> Enable / Disable</a>&nbsp;
                                                
                                               

                                            </div>
                                            <div class="air air-top-left padding-10">
                                                <h4 class="txt-color-white font-md"><?php echo "Date Created: ".date('D, M j, Y', strtotime(auth()->user()->created_at)); ?></h4>
                                            </div>
                                            <ol class="carousel-indicators">
                                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <!-- Slide 1 -->
                                                <div class="item active">
                                                    <img src="{{ asset('admin_assets/img/demo/s1.jpg'); }}" alt="demo user">
                                                </div>
                                                <!-- Slide 2 -->
                                                <div class="item">
                                                    <img src="{{ asset('admin_assets/img/demo/s2.jpg'); }}" alt="demo user">
                                                </div>
                                                <!-- Slide 3 -->
                                                <div class="item">
                                                    <img src="{{ asset('admin_assets/img/demo/m3.jpg'); }}" alt="demo user">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row">
                                        <form method="POST" action="{{ route('agent.update_profile_img'); }}" enctype="multipart/form-data" id="form_profile_img">
                                                @csrf
                                            <div class="col-sm-3 profile-pic1">
                                            
                                            <?php 
                                               
                                               if(auth()->user()->profile_img == 'none'){
                                                    $img = asset('profile_img/avatar-agent.jpg');
                                               }else{
                                                   $img = asset('profile_img/'.auth()->user()->profile_img);
                                               }

                                            ?>
                                             
                                                <img src="<?php echo $img; ?>" alt="demo user" id="profilePreview">
                                                <input type="file" name="profilePhoto" id="profilePhoto" style="display:none;">
                                                <div class=" " style="text-align:center; margin-bottom: 10px;"> 
                                                    <input type="button" class="btn btn-sm btn-default" value="Update Profile Photo" onclick="upload_profile_photo()"></br>
                                                </div>
                                                <div class=" " id="uploadProfilebtn"style="text-align:center;  margin-bottom: 10px; display:none; "> 
                                                     <input type="submit" class="btn btn-sm btn-primary" value="Upload Profile Photo">
                                                </div>
                                            
                                            </div>
                                        </form>
                                            <div id="div-edit" class="col-sm-6">
                                                <h1><?php echo auth()->user()->firstname; ?> <span class="semi-bold"><?php echo auth()->user()->lastname; ?> </span>
                                                <br>
                                                <small> Agent </small></h1>

                                                <ul class="list-unstyled">
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-phone"></i>&nbsp;&nbsp;<a href="javascript:void(0);" class="edit" id="date_of_birth" data-type="combodate" data-value="<?php echo auth()->user()->date_of_birth; ?>" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1" data-original-title="Select Date of birth"></a></span>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="javascript:void(0);" class="edit" id="email" data-type="text" data-pk="1" data-original-title="Enter Email"><?php echo auth()->user()->email; ?></a>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-skype"></i>&nbsp;&nbsp;<span class="txt-color-darken"><a href="javascript:void(0);" class="edit" id="username" data-type="text" data-pk="1" data-original-title="Enter Username"><?php echo auth()->user()->username; ?></a></span>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <?php
                                                            
                                                            if(auth()->user()->date_verified_at == NULL){
                                                                $ver = '<span class="label label-danger">Not verified</span>';
                                                            }else{
                                                                $ver =  '<span class="txt-color-darken">Date Verified on<a href="javascript:void(0);" rel="tooltip" title="" data-placement="top" data-original-title="Date Verified">  '.date('F d, Y', strtotime(auth()->user()->date_verified_at)).'</a></span>';
                                                            }
                                                            ?>
                                                            <i class="fa fa-calendar"></i>&nbsp;&nbsp; <?php echo $ver; ?>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <br>
                                                <p class="font-md">
                                                    <i>A little about me...</i>
                                                </p>
                                                <p>

                                                <a href="javascript:void(0);" id="about_me" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-original-title="About me.."><?php if(auth()->user()->about_me == NULL){ echo "No contents .."; }else{echo auth()->user()->about_me;} ?></a>

                                                </p>
                                                <br>
                                                
                                                <br>
                                                <br>
                                            </div>
                                            

                                        </div>
                                        <div class="row">
                                            <form action="{{ route('agent.add_documents'); }}" method="post" id="document-form" class="smart-form" novalidate="novalidate" enctype="multipart/form-data">
                                            @csrf    
                                            <header>Add documents</header> 
                                                <fieldset>					
                                                   
                                                <section>
													<label class="label">Select documents <span>(required)</span></label>
													<label class="select">
														<select id="id_type" name="id_type">
                                                            <option value="" disabled selected>Select type of ID's</option>
															<!-- <option value="Passport">Passport</option>
															<option value="SSS ID">SSS ID or SSS Umid Card</option>
															<option value="GSIS ID or GSIS Umid Card">GSIS ID or GSIS Umid Card</option>
															<option value="Driver License">Driver License</option>
                                                            <option value="PRC ID">PRC ID</option>
                                                            <option value="Philhealt ID">Philhealth ID</option>
                                                            <option value="Pagibig ID">Pagibig ID</option> -->

                                                            <?php foreach($document_select as $opt){
                                                                   echo '<option value="'.$opt.'">'.$opt.'</option>';
                                                                } 
                                                            ?>
                                                            <option value="Other">Other</option>
														</select> <i></i> </label>
												</section>
                                                <section id="new_field">
                                                </section>
                                                <section>
                                                    <label class="label">ID descriptions <span>(optional)</span></label>
                                                    <label class="textarea">
                                                        <i class="icon-append fa fa-edit"></i>
                                                        <textarea rows="4" name="document_desc" id="message"></textarea>
                                                    </label>
                                                </section>
                                                <section>
													<label class="label">File input</label>
													<div class="input input-file">
														<span class="button"><input type="file" id="file" name="documentImg" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
													</div>
												</section>
                                                </fieldset>
                                                
                                                <footer>
                                                    <button type="submit" class="btn btn-primary" id="add_doc_btn">Submit</button>
                                                </footer>
                                                 
                                            </form>	
                                        </div>
                                    </div>
                                </div>
                            
                                        
                                </div>						
							</article>
							<!-- END COL -->
                            <!-- NEW COL START -->
							<article class="col-sm-5 col-md-5 col-lg-5">
                                <div class="well well-light">
                                        <div class="row">
                                                <h2>Change Password: </h2>
                                                <ul>
                                                    <li>Must have a capital letter.</li>
                                                    <li>Must contain a number</li>
                                                    <li>Minimum of 6 digits charater.</li>
                                                    <li>Must contain a punctuation.</li>
                                                </ul>
                                                <form id="password-form" class="smart-form" method="POST" action="{{ route('agent.change_password'); }}"> 
                                                        
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
                                <hr>
                                <div class="well well-light">
                                    <div class="row no-padding">
                                        <div class="panel-group smart-accordion-default" id="accordion-2">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseOne-1"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i> Broker Details </a></h4>
                                                </div>
                                                <div id="collapseOne-1" class="panel-collapse collapse in">
                                                    <div class="panel-body">
                                                    <div class="col-md-12 padding-left-0">
                                                    <?php if($num == 0){; ?>
                                                            <form id="order-form" action="{{ route('agent.create_broker') }}" class="smart-form" novalidate="novalidate" enctype="multipart/form-data" method="POST" >
                                                            @csrf        
                                                                    <header>
                                                                        Add Broker License  <?php echo $num; ?>
                                                                    </header>
                                                                    <fieldset>
                                                                            <section>
                                                                                <img src="{{ asset('broker_img/no-preview.jpg');}}" id="blah" style="width: 100%;padding-bottom:15px;"> 
                                                                            </section>

                                                                            <section>
                                                                            <div class="input input-file">
                                                                                <span class="button"><input id="file2" type="file" name="broker_img_license" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" id="next-in"  placeholder="Include some files" readonly="">
                                                                            </div>
                                                                            </section>

                                                                            <section >
                                                                                <label class="input"> <i class="icon-append fa fa-briefcase"></i>
                                                                                    <input type="text" name="broker_name" placeholder="Company">
                                                                                </label>
                                                                            </section>

                                                                            <section>
                                                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                                                                                    <textarea rows="5" name="broker_details" placeholder="Add Details"></textarea> 
                                                                                </label>
                                                                            </section>
                                                                    </fieldset>
                                                                    <footer>
                                                                        <button type="submit" class="btn btn-primary" id="add_broker_btn">
                                                                            Submit
                                                                        </button>
                                                                    </footer>
                                                            </form>
                                                    <?php }else{; ?>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <form method="POST" action="{{ route('agent.update_broker_img'); }}" enctype="multipart/form-data" id="form_broker_img">
                                                                    @csrf
                                                                    <img src="<?php echo asset('broker_img/'.$result[0]['broker_img_license']); ?>" id="brokerLicImg" class="img-responsive" alt="img">
                                                                    <br>
                                                                    <input type="file" name="broker_license_update_img" id="broker_license_update_img" style="display:none;" >
                                                                    <a class="btn btn-default" href="javascript:void(0);" onclick="updateBrokerImg()"> <i class="fa fa-camera"></i> Upload Broker </a>
                                                                    <input type="hidden" value="<?php echo $result[0]['broker_id']; ?>" name="broker_id">
                                                                    <input type="submit" class="btn btn-sm btn-success" style="display:none;" value="Upload" id="submit-btn-broker-new">
                                                                </form>
                                                            </div>
                                                            <div class="col-md-6 padding-left-0">
                                                                <h3 class="margin-top-0"><a href="javascript:void(0);" class="edit" id="broker_name" data-type="text" data-pk="1" data-broker-id="<?php echo $result[0]['broker_id']; ?>" data-original-title="Update Broker Name"><?php echo $result[0]['broker_name']; ?></a></i></small></h3>
                                                                <a href="javascript:void(0);" id="broker_details" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-broker-id="<?php echo $result[0]['broker_id']; ?>" data-original-title="Update Broker Details"><?php echo $result[0]['broker_details']; ?></a>
                                                            </div>
                                                        </div>
                                                    <?php }; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $x = 1; foreach($document as $res){ $x++; ?>  
                                            <div class="panel panel-default" id="panel-accordion-document_id_<?php echo $res['document_id']; ?>">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-<?php echo $x; ?>" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i> <?php echo ucwords($res['document_name']);?> </a></h4>
                                                </div>
                                                <div id="collapseTwo-<?php echo $x; ?>" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <img src="<?php echo asset('document_img/'.$res['document_img']); ?>" class="img-responsive" alt="img">
                                                                
                                                            </div>
                                                            <div class="col-md-6 padding-left-0">
                                                                <p>
                                                                    <?php echo $res['description']; ?>
                                                                </p>
                                                                <a class="btn btn-danger" href="javascript:void(0);" onclick="removeDocument(<?php echo $res['document_id']; ?>)"><i class="fa fa-file"> </i> Delete File </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <?php }  ?>
                                        </div>
                                    </div>
                                </div>
                            </article>
							<!-- END COL -->
						</div>

						<!-- END ROW -->

					</section>
					<!-- end widget grid -->

                        <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-info-circle"></i> Request for account review</h4>
                                        </div>
                                        <div class="modal-body">
                            
                                            <p style="text-align: center; font-style: italic;">Before submitting a request for account review, please make sure to provide the most important information like email, phone number and valid ID's as the administrator base their decision as what they can see in your account. 
                                                The most detailed and complete information on your account will have the highest possibility for your account to be approved.  </p>
                                                <br>
                                                <?php 
                                                $submit_req_btn = '';
                                                // /echo json_encode($review);
                                               // echo count($review);
                                                if(count($review) > 0 ){
                                                    echo "<table class='table table-bordered'>";
                                                    echo "<thead><tr>";
                                                    echo "<td>Date Requested</td>";
                                                    echo "<td>Remarks</td>";
                                                    echo "<td>Status</td>";
                                                    echo "<tr></thead>";
                                                        foreach($review as $rev_result){

                                                            $details = $rev_result['details_of_result'];

                                                            if($rev_result['details_of_result'] == NULL || $rev_result['details_of_result'] == ''){

                                                                $details ='<p style="font-style: italic;">No content</p>';

                                                            }

                                                            if($rev_result['status'] == 'pending'){
                                                                $status = 'warning';
                                                                $submit_req_btn = 'disabled="disabled"';
                                                            }
                                                            if($rev_result['status'] == 'completed'){
                                                                $status = 'success';
                                                            }
                                                            if($rev_result['status'] == 'rejected'){
                                                                $status = 'danger';
                                                            }
                                                            if($rev_result['status'] == 'deactivated'){
                                                                $status = 'danger';
                                                            }
                                                                echo "<tr>";
                                                                echo "<td>".date('F d, Y h:i A', strtotime($rev_result['created_at']))."</td>";
                                                                echo "<td>".$details."</td>";
                                                                echo "<td><label class='label label-".$status."'>".ucwords($rev_result['status'])."</label></td>";
                                                                echo "</tr>";
                                                            
                                                        }
                                                    echo "</table>";
                                                }
                                                
                                                    if(auth()->user()->email_verified_at == NULL){
                                                        $submit_req_btn = 'disabled="disabled"';

                                                        echo '<div class="alert alert-warning fade in">
                                                                <button class="close" data-dismiss="alert">
                                                                    ×
                                                                </button>
                                                                <i class="fa-fw fa fa-warning"></i>
                                                                  Please verify your email since that is one of the minimum requirement to verify your account.
                                                            </div>';
                                                    }
                                                ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="button" class="btn btn-primary" onclick="submit_request_for_approval()" <?php echo  $submit_req_btn; ?> id="btn_req_submit">
                                                Submit request for Approval
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

<script src="{{ asset('admin_assets/js/plugin/x-editable/moment.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/x-editable/jquery.mockjax.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/x-editable/x-editable.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/dropzone/dropzone.min.js') }}"></script>
<script>
    $(document).ready(function(){ 

        

        $('#date_of_birth').editable({
            url: "{{ route('agent.update_user_details'); }}", 
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
        
//=============== UPDATE EMAIL X-EDITABLE ====================
        $('#email').editable({
            url: "{{ route('agent.update_user_details'); }}", 
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
//====================================================================

//===================== UPDATE USERNAME ==============================
$('#username').editable({
            url: "{{ route('agent.update_user_details'); }}", 
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
//======================================================================


    $('#about_me').editable({
            showbuttons: 'bottom',
            url: "{{ route('agent.update_user_details'); }}", 
            type: 'text',
            title: 'Edit category', 
            ajaxOptions: {
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
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



    $('#form_broker_img').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
 
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){

                $.smallBox({
                    title : "Broker License image sucessfully uploaded",
                    content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
                    color : "#739E73",
                    iconSmall : "fa fa-check bounce animated",
                    timeout : 4000
                });

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

    $('#form_profile_img').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
 
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){

                $.smallBox({
                    title : "Profile picture has been updated sucessfully uploaded",
                    content : "2 seconds ago...</i>",
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

    $('#document-form').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        $('#add_doc_btn').text('Submitting...');
        $('#add_doc_btn').prop('disabled', true);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){

                if(data == 'SUCCESS'){

                    $.smallBox({
                        title : "A new document added was sucessfully uploaded",
                        content : "<i>2 seconds ago...</i>",
                        color : "#739E73",
                        iconSmall : "fa fa-check bounce animated",
                        timeout : 4000
                    });
                    //$('#document-form [name='+index+']').removeAttr("style");

                    $("#document-form")[0].reset();
                    window.location.reload();

                }else{

                    console.log(data);
                    var json = $.parseJSON(data);
                   // console.log(json.length);
                    var contents='';

                    $.each(json, function(index, element) {
                        //console.log(index);
                        //$('#document-form [name='+index+']').attr("style", "border:1px red solid;");


                        $.each(element, function(index2, element2) {
                            contents = contents+'<li>'+element2+'</li>';
                        });
                        
                    });

                    $.smallBox({
                        title : "FAILED!",
                        content : contents,
                        color : "#C46A69",
                        iconSmall : "fa fa-times bounce animated",
                        timeout : 4000
                    });

              
                    
                }

                $('#add_doc_btn').text('Submit');
                $('#add_doc_btn').prop('disabled', false);

            },
            error: function(data){
                $.smallBox({
                    title : "FAILED!",
                    content : data,
                    color : "#C46A69",
                    iconSmall : "fa fa-times bounce animated",
                    timeout : 4000
                });
            }
        });

    }));

    $("#ImageBrowse").on("change", function() {
        $("#imageUploadForm").submit();
    });

$('#id_type').on('change', function(){

    console.log(this.value);

    if(this.value == 'Other'){

        var format_n = '<label class="input"> <i class="icon-append glyphicon glyphicon-credit-card"></i> <input type="text" name="specify_type_of_id"   placeholder="Specify the type of ID" required> </label>';
        $('#new_field').html(format_n);
    }else{
        $('#new_field').html('');
    }

   
});

}); //end of document ready
		    //enable / disable
$('#enable').click(function () {
    $('#div-edit .editable').editable('toggleDisabled');
});

<?php if($num == 0){?>

file2.onchange = evt => {
  const [file] = file2.files

  document.getElementById('next-in').value = file2.value;
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
<?php } else {?>
    broker_license_update_img.onchange = evt => {
        const [file] = broker_license_update_img.files
 
        if (file) {
            brokerLicImg.src = URL.createObjectURL(file)
        }
    }
<?php } ?>
 

profilePhoto.onchange = evt => {
        const [file] = profilePhoto.files
 
        if (file) {
            profilePreview.src = URL.createObjectURL(file)
        }
    }

var $orderForm = $("#order-form").validate({
				// Rules for form validation
				rules : {
					file2 : {
						required : true
					},
					broker_title : {
						required : true, 
					},
					broker_details : {
						required : true
					} 
				},
	
				// Messages for form validation
				messages : {
					file2 : {
						required : '<p style="color:red;">Broker license image is required!</p>'
					},
                    broker_img_license : {
						required : '<p style="color:red;">Please your company name!</p>', 
					},
					broker_details : {
						required : '<p style="color:red;">Please broker details!</p>'
					}
				}, 
                // Ajax form submition
                submitHandler : function(form) {
                    $(form).ajaxSubmit({
                        beforeSend: function() { 
                            document.getElementById('add_broker_btn').value = 'Submitting ...';  
                            $('#add_broker_btn').prop('disabled', true);
                        },
                        success : function(res) { 

                            window.location.reload();
                        }
                    });
                },
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});

    $('#broker_details').editable({
            showbuttons: 'bottom',
            params: function(params) { 
                params.broker_id = $(this).attr("data-broker-id"); 
                return params;
            },
            url: "{{ route('agent.update_broker_details'); }}", 
            type: 'text',
            title: 'Edit category', 
            ajaxOptions: {
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
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

    $('#broker_name').editable({
            showbuttons: 'bottom',
            params: function(params) { 
                params.broker_id = $(this).attr("data-broker-id"); 
                return params;
            },
            url: "{{ route('agent.update_broker_details'); }}", 
            type: 'text',
            title: 'Edit category', 
            ajaxOptions: {
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
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


   function updateBrokerImg(){ 

       $('input[name=broker_license_update_img]').click();
       
   }

   $('input[name=broker_license_update_img]').on('change',function(){

       //console.log(this.value);
       if(this.value == null || this.value == ''){

            $('#submit-btn-broker-new').show('false');

       }else{

            $('#submit-btn-broker-new').show('true');
        
       }
       
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

function removeDocument(id){
 
        $.SmartMessageBox({
            title : "Remove file!",
            content : "Are you sure you wanted to remove this document?",
            buttons : '[No][Yes]'
        }, function(ButtonPressed) {
            if (ButtonPressed === "Yes") { 
                $.ajax({
                    url: "{{ route('agent.remove_document'); }}",
                    method: "POST",
                    cache: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data : {'document_id': id},
                    success: function(data){
                        $.smallBox({
                            title : "Remove file successfull",
                            content : "<i class='fa fa-check'></i> <i>File successfully remove</i>",
                            color : "#659265",
                            iconSmall : "fa fa-check fa-2x fadeInRight animated",
                            timeout : 4000
                        });

                        $('#panel-accordion-document_id_'+id).fadeOut('slow');

                        window.location.reload();

                    }
                });
                
            } 

        }); 

    
}

function send_code(){
		$.SmartMessageBox({
			title : "Verify Email",
			content : "Please click \'YES\' to send verification to email!",
			buttons : '[No][Yes]'
		}, function(ButtonPressed) {
			if (ButtonPressed === "Yes") {
                $('#verify_email_div').html('<img style="width: 30px;"  src="{{ asset("admin_assets/img/loading/spinner.svg"); }}">');
				$.ajax({
					"url" : "{{ route('agent.agent_verify_email'); }}",
					"headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					"method" : "POST", 
					// "beforeSend": function(){
						
					// },
					"success": function(data){
						
						if(data != 'FAILED'){
						
						
							$('#verify_email_div').html(data);

						}else{
							$.smallBox({
								title : "ERROR",
								content : data,
								color : "#659265",
								iconSmall : "fa fa-times fa-2x fadeInRight animated",
								timeout : 4000
							});

							$('#verify_email_div').html('<a href="javascript:void(0)" class="link" onclick="send_code()">Send verification code to email.</a>');
						}
						
					}

				}); 
			}

		});
	//e.preventDefault();
}

function submit_request_for_approval(){

    $('#btn_req_submit').text('submitting..');
    $('#btn_req_submit').prop('disabled', true);

    $.ajax({
        url: "{{ route('agent.submitApplication'); }}",
        method: "POST",
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
        success: function(data){
            $.smallBox({
                title : "Request has been submitted!",
                content : "<i class='fa fa-check'></i> <i>Please wait for your account to be reviewed within 24-48 hours depending on the volume of the request.</i>",
                color : "#659265",
                iconSmall : "fa fa-check fa-2x fadeInRight animated",
                timeout : 4000
            });
            
            $('#myModal').hide();
            window.location.reload();

        }
    });
}

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

                            $("#password-form")[0].reset();

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
</script>
<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>
@include('admin.content.footer-new.footer-last-new')

