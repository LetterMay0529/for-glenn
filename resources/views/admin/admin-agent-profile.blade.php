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
					<li>Agent</li><li>Agent Profile</li>
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
                                    Agent Profile
								</span>
							</h1>
						</div>
						
					</div>

					

					<!-- widget grid -->
					<section id="widget-grid" class="">
						<!-- START ROW -->
						<div class="row">
                            <!-- NEW COL START -->
 
							<article class="col-sm-12 col-md-12 col-lg-12" id="approval_div">
                                <div class="well well-light">
									<p style="font-style:italic;">"<span style="font-weight:bold;"> Note: </span> Please thoroughtly investigate the agent's account before accepting and rejecting account approval's request." Any errors found during approvals process may take against you. Any information submitted was recorded and might be investigated if found that the company policy was not followed. 
									<br> <br>
									Please refer to the information below for reference during investigation.</p>
									<ul>
										<li>Passport </li>
										<li>SSS ID or SSS Umid Card </li>
										<li>GSIS ID or GSIS Umid Card </li>
										<li>Driver License </li>
										<li>PRC ID </li>
										<li>Philhealth ID </li>
										<li>Pagibig ID </li>
									</ul>

									<p style="font-style:italic;">This are the valid ID's we accept. </p>
									<br>
									<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#approveModal">Approved Request</button> 
									<button class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#rejectModal">Reject Request</button>  
                                </div>						
							</article>
							<!-- END COL --> 
						</div>
						
						<div class="row">
                            <!-- NEW COL START -->
							<article class="col-sm-7 col-md-7 col-lg-7">
                                <div class="well well-light">
									
                                <div class="row no-padding">
				
                                    <div class="col-sm-12">
                                        <div id="myCarousel" class="carousel fade profile-carousel">
                                            <div class="air air-bottom-right padding-10">
                                    		</div>
                                            <div class="air air-top-left padding-10">
                                                <h4 class="txt-color-white font-md"><i class="fa fa-calendar"></i> <?php echo "Date Created: ".date('F d, Y', strtotime($data[0]->created_at)); ?></h4>
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
                                         
                                            <div class="col-sm-3 profile-pic1">
                                            
                                            <?php 
                                               
                                               if($data[0]->profile_img == 'none'){
                                                    $img = asset('profile_img/avatar-agent.jpg');
                                               }else{
                                                   $img = asset('profile_img/'.$data[0]->profile_img);
                                               }

                                            ?> 
                                                <img src="<?php echo $img; ?>" alt="demo user" id="profilePreview"> 
                                            </div> 
                                            <div id="div-edit" class="col-sm-6">
                                                <h1><?php echo $data[0]->firstname.' '.$data[0]->lastname; ?> </span>
                                                <br>
                                                <small> Agent </small></h1>

                                                <ul class="list-unstyled">
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-phone"></i>&nbsp;&nbsp; <?php echo $data[0]->phone; ?></span>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-envelope"></i>&nbsp;&nbsp;<?php echo $data[0]->email; ?>  <?php if($data[0]->email_verified_at != NULL){ echo '<i class="fa fa-check-circle" style="color:green; "> </i>';}?>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-skype"></i>&nbsp;&nbsp;<span class="txt-color-darken"><?php echo $data[0]->username; ?></span>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <?php
                                                            
                                                            if($data[0]->date_verified_at == NULL){
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
                                                <p> <?php echo $data[0]->about_me;?></p>
                                                <br>
                                                
                                                <br>
                                                <br>
                                            </div> 
                                        </div>  
										<div class="row">
											<h1 style="text-align:center; "><span>------------------------</span> Request Activity History <span>------------------------</span></h1>
											<br>
											<!-- Timeline Content -->
												<div class="smart-timeline">
													<ul class="smart-timeline-list">
														<?php foreach($activity as $list){ ?>
														<li>
															<div class="smart-timeline-icon"> 
																<?php

																if($list->username != NULL){
																	if($list->profile_img =='none'){
																		echo '<i class="fa fa-user"> </i>';
																	}else{
																		echo '<img src="'.asset('profile_img/'.$list->profile_img).'" width="32" height="32" alt="user" />';
																	}
																}else{
																	echo '<i class="fa fa-user"> </i>';
																}	
																?>
																<!-- <img src="img/avatars/sunny.png" width="32" height="32" alt="user" /> -->
															</div>
															<div class="smart-timeline-time">
																<small><?php echo date('F d Y h:i:s A', strtotime($list->created_at)); ?></small>
															</div>
															<div class="smart-timeline-content">
																<p>
																	<a href="javascript:void(0);">&nbsp;<?php if($list->username == NULL){ echo "_____________";}else{echo $list->username;}; ?></a>
																</p>
																<p>
																<?php if($list->details_of_result == NULL){ echo "<p style='font-style:italic;color:grey;'>\"No remarks yet\". Account currently on review.</p>"; }else{echo $list->details_of_result;} ?>
																</p>
																<p>
																	<?php 
																		if($list->status == 'pending'){
																			$status = 'warning';
																		}else if($list->status == 'rejected'){
																			$status = 'danger';
																		}else{
																			$status = 'success';
																		}

																		?>
																	Status: <label class="label label-<?php echo $status; ?>"> <?php echo $list->status; ?></label>
																</p>
															 
															</div>
														</li>
														<?php }?>
													</ul>
												</div>
												<!-- END Timeline Content -->
										</div> 
                                    </div>
                                </div>
                            
                                        
                                </div>						
							</article>
							<!-- END COL -->
                            <!-- NEW COL START -->
                            <?php if(count($broker) > 0 ){ ?>
                                <article class="col-sm-5 col-md-5 col-lg-5">
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
                                                        <div class="row">
                                                                <div class="col-md-6">
                                                                        <img src="<?php echo asset('broker_img/'.$broker[0]->broker_img_license); ?>" id="brokerLicImg" class="img-responsive" alt="img">
                                                                        <br>  
                                                                </div>
                                                                <div class="col-md-6 padding-left-0">
                                                                    <h3 class="margin-top-0"><?php echo $broker[0]->broker_name; ?></h3>
                                                                    <?php echo $broker[0]->broker_details; ?>
                                                                </div>
                                                            </div>
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
                            <?php } ?>
							<!-- END COL -->
						</div>

						<!-- END ROW -->

					</section>
					<!-- end widget grid -->
						<!-- START REJECTED MODAL	 -->
						<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Reject Request</h4>
									</div>
									<form method="POST" action="{{ route('admin.reject_agent_account'); }}" id="reject-form">
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
												
													<div class="form-group">
														<input type="hidden" name="review_id" value="<?php echo $data[0]->review_id; ?>">
														<textarea class="form-control" placeholder="Details of Findings" rows="5" name="details_of_result"></textarea>
													</div>

												</div>
											</div> 
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Cancel
											</button>
											<button type="submit" class="btn btn-danger">
												Reject
											</button>
										</div>
									</form>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<!-- eEND REJECTED MODAL	 -->

						<!-- START APPROVE MODAL	 -->
						<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Approval Request</h4>
									</div>
									<form method="POST" action="{{ route('admin.approve_agents_account'); }}" id="approve-form">
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
												
													<div class="form-group">
														<input type="hidden" name="users_id" value="<?php echo $data[0]->users_id; ?>">
														<input type="hidden" name="review_id" value="<?php echo $data[0]->review_id; ?>">
														<textarea class="form-control" placeholder="Details of Findings" rows="5" name="details_of_result"></textarea>
													</div>

												</div>
											</div> 
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">
												Cancel
											</button>
											<button type="submit" class="btn btn-success">
												Approved
											</button>
										</div>
									</form>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<!-- END APPROVE MODAL	 -->
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

 
<script> 

$(document).ready(function(){

	var $reject_form = $("#reject-form").validate({
	
    // Rules for form validation
    rules : {
        details_of_result : {
            required : true
        } 
    },

    // Messages for form validation
    messages : {
        details_of_result : {
            required : '<p style="color:red"> Please provide description of rejection. </p>'
        }
    },
    submitHandler : function(form) {

		$(form).ajaxSubmit({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success : function(res) {
                    if(res == 'SUCCESS'){

                        $.smallBox({
                            title : "Account was successfully rejected!",
                            content : "<i class='fa fa-check-o'></i> <i>2 seconds ago...</i>",
                            color : "#739E73",
                            iconSmall : "fa fa-check bounce animated",
                            timeout : 4000
                        });

						$('#approval_div').hide();
						$('#rejectModal').modal('hide');


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

	var $approve_form = $("#approve-form").validate({
	
    // Rules for form validation
    rules : {
        details_of_result : {
            required : true
        } 
    },

    // Messages for form validation
    messages : {
        details_of_result : {
            required : '<p style="color:red"> Please provide details of approval. </p>'
        }
    },
    submitHandler : function(form) {

		$(form).ajaxSubmit({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success : function(res) {
                    if(res == 'SUCCESS'){

                        $.smallBox({
                            title : "Account was successfully approved! The agent can now start using the account",
                            content : "<i class='fa fa-check-o'></i> <i>2 seconds ago...</i>",
                            color : "#739E73",
                            iconSmall : "fa fa-check bounce animated",
                            timeout : 4000
                        });

						$('#approval_div').hide();
						$('#approveModal').modal('hide');


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
     
});
</script>
 
<!-- CUSTOM NOTIFICATION -->
<script src="{{ asset('admin_assets/js/notification/SmartNotification.min.js'); }}"></script> 
		<!-- JQUERY VALIDATE -->
<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>


@include('admin.content.footer-new.footer-js-new')
@include('admin.content.footer-new.footer-last-new')

