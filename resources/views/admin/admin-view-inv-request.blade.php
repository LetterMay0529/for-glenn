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
					<li>Admin</li><li>Investigation Request</li><li>New Request List</li><li>Request Details <?php 
													if($result[0]->status == 'new'){
														echo "<span class='label label-warning'> New </span>";
													}else if($result[0]->status == 'pending'){
														echo "<span class='label label-primary'> Pending </span>";
													}else if($result[0]->status == 'completed'){
														echo "<span class='label label-success' width> Completed </span>";
													}else{
														echo '';
													} ?>
												</li>
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
                                    Investigation Request
								<span>>  
                                    Request List
								</span>
                                <span>>  
                                    Request Details
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
									<div class="col-md-3">
										<img src="<?php echo asset('property_img/'.$result[0]->prop_img);?>" class="img-responsive" alt="img">
									
									</div>
									<div class="col-md-8 padding-left-0">
											<h3 class="margin-top-0"><a href="javascript:void(0);"> <?php echo ucwords($result[0]->title); ?> </a><br><small class="font-xs"><i>Request to be investigated by <a href="javascript:void(0);"><?php echo $result[0]->firstname.' '.$result[0]->lastname; ?></a></i></small></h3>
											<p> 
											<strong>Price: </strong>
											₱ <?php echo number_format($result[0]->amount, 2); ?>
											</p> 
											<p> 
											<strong>Size: </strong>
											<?php echo $result[0]->property_size; ?> SQM
											</p> 
											<p> 
											<strong>Details of Issue/Problem: </strong>
											<?php echo nl2br(e(ucwords($result[0]->details))); ?> 
											</p> 
										</div>
								</div>
							</div>
							<!-- end widget -->

							

							<?php if(count($notes) > 0){?>
							<div class="well well-sm">
								<!-- Timeline Content -->
								<div class="smart-timeline">
									<ul class="smart-timeline-list">
										
										<?php foreach($notes as $val){ ?>

										<li>
											<div class="smart-timeline-icon">
												<i class="fa fa-user"></i>
											</div>
											<div class="smart-timeline-time">
												<small><?php echo date('F d, Y h:i:s A', strtotime($val->created_at))?></small>
											</div>
											<div class="smart-timeline-content">
												<p>
													<a href="javascript:void(0);"><strong><?php echo $val->firstname.' '.$val->lastname; ?></strong></a>
												</p>
												<p >
													<?php echo nl2br(e($val->notes_details)); ?>
												</p>
												 
											</div>
										</li>

										<?php } ?>

										<!-- <li>
											<div class="smart-timeline-icon">
												<i class="fa fa-pencil"></i>
											</div>
											<div class="smart-timeline-time">
												<small>12 Mar, 2013</small>
											</div>
											<div class="smart-timeline-content">
												<p>
													<a href="javascript:void(0);"><strong>Nabi Resource Report</strong></a>
												</p>
												<p>
													Ean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis.
												</p>
												<a href="javascript:void(0);" class="btn btn-xs btn-default">Read more</a>
											</div>
										</li>  -->
									</ul>
								</div>
								<!-- END Timeline Content -->
							</div>
							<?php }else{  ?>
								<div class="well well-light col-sm-12">
				
										<div class="well well-sm bg-color-darken txt-color-white text-center">
											<h5>No investigation details yet.</h5> 
										</div>
				
									</div>
							<?php } ?>

							<!-- Widget ID (each widget will need unique ID)-->
							<div class="well well-light">
								<div class="row">
									<!-- widget content -->
									<?php if($result[0]->status != 'closed'){ ?>
									<div class=""> 
										<form id="add_notes_form" method="POST" class="smart-form" action="{{ route('admin.insert_notes') }}" novalidate="novalidate">
											@csrf	
										<header>
												Add Notes 
												 
											</header>  

											<fieldset>
												<section>
													<label class="select col-md-4">
														<input type="hidden" name="inv_id" value="<?php echo $inv_id; ?>"> 
														<select name="status">
															<option value="0" selected="" disabled="">STATUS</option>
															<option value="new" <?= $result[0]->status == 'new' ? ' selected="selected"' : '';?>>New</option>
															<option value="pending" <?= $result[0]->status == 'pending' ? ' selected="selected"' : '';?>>Pending</option>
															<option value="completed" <?= $result[0]->status == 'completed' ? ' selected="selected"' : '';?>>Completed</option>
															<?php 
															if($result[0]->status == 'completed'){
																echo '<option value="closed">Closed</option>';
															} 
															?>
														</select> <i></i> </label>
												</section><br><br>
												<section>
													<label class="textarea"> <i class="icon-append fa fa-pencil"></i> 										
														<textarea rows="5" id="notes_textarea" style="white-space: pre-wrap;" name="notes_details" placeholder="Tell us about your project"></textarea> 
													</label>
												</section>
											</fieldset>

											<footer>
												<input type="submit" id="btn_id_add_notes" class="btn btn-primary" value="Add Notes">
													 
											</footer>
										</form> 
									</div>
									<?php }else{ ?>

										<div class="alert alert-info fade in">
											<button class="close" data-dismiss="alert">
												×
											</button>
											<i class="fa-fw fa fa-info"></i>
											<strong>Info!</strong> This request was already closed.
										</div>
										<?php } ?>
								<!-- end widget content -->
									</div>
								</div>
							<!-- end widget -->
					
					
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
		
        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
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
		<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>
		<script>
			$(document).ready(function(){

            });

			var $add_notes_form = $("#add_notes_form").validate({
	
			// Rules for form validation
			rules : {
				notes_details : {
					required : true
				} 
			},

			// Messages for form validation
			messages : {
				notes_details : {
					required : '<p style="color:red">Please Provide a notes details.</p>'
				}
			},
    	submitHandler : function(form) {

			$(form).ajaxSubmit({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function() { 
                    document.getElementById('btn_id_add_notes').value = 'Submitting ...';  
                    $('#btn_id_add_notes').prop('disabled', true);
                },
                success : function(res) {

                    document.getElementById('btn_id_add_notes').value = 'Add Notes';  
                    $('#btn_id_add_notes').prop('disabled', false);

                    if(res == 'SUCCESS'){

                        $.smallBox({
                            title : "Details updated!",
                            content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
                            color : "#739E73",
                            iconSmall : "fa fa-check bounce animated",
                            timeout : 4000
                        });
   
                        $('textarea#notes_textarea').val('');
						window.location.reload();

                    }else{
                        
                        $.smallBox({
                            title : "FAILED!!",
                            content : "QUERY to database failed!",
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
<!-- JQUERY VALIDATE -->

@include('admin.content.footer')

