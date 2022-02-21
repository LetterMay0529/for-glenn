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

		<!-- MAIN PANEL -->
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
					<li>Home</li><li>Tables</li><li>Data Tables</li>
				</ol>


			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">

				
				<!-- widget grid -->
				<section id="widget-grid" class="">
				
					<!-- row -->
					<div class="row">
                        <!-- NEW WIDGET START -->
						<?php if(count($data) > 0){ ?>
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="well well-light">

                                <!-- widget div-->
                                <div> 
                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
										<!-- widget grid -->
										<section id="widget-grid" class="">
								
											
											<div class="row">
												<!-- NEW COL START -->
												<article class="col-sm-12 col-md-12 col-lg-12">
													<div class="well well-light">
														
													<div class="row no-padding">
									
														<div class="col-sm-12">
															<div id="myCarousel" class="carousel fade profile-carousel">
																<div class="air air-bottom-right padding-10">
																</div>
																<div class="air air-top-left padding-10">
																	<!-- <h4 class="txt-color-white font-md"> <?php //echo "<i class='fa fa-calendar'></i> Date Created: ".date('F d, Y', strtotime($data[0]->created_at)); ?></h4> -->
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
																<div id="div-edit" class="col-sm-3">
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
																	<br>
																</div> 
																<div  class="col-sm-5"> 
																<br>
																<p class="font-md">
																		<i>A little about me...</i>
																	</p>
																	<p> <?php echo $data[0]->about_me;?></p>
																</div>
															</div> 
															
														</div>
													</div>
												
															
													</div>						
												</article>
												<!-- END COL -->
										
											</div>

											<!-- END ROW -->

										</section>

                                    </div>
                                    <!-- end widget content -->
                
                                </div>
                                <!-- end widget div -->
                
                            </div>
                            <!-- end widget -->
                
                        </article>
                        <!-- WIDGET END -->
						<?php } ?>
						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
							<!-- Widget ID (each widget will need unique ID)-->
							<div class="well well-light">
		
		  
								<!-- widget div-->
								<div> 
									<!-- widget content -->
									<div class="widget-body no-padding">
				
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>			                
												<tr>
													<th data-class="expand" style="width:70%;"><i class="fa fa-fw fa-building text-muted hidden-md hidden-sm hidden-xs"></i> Title</th>
													<th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date Posted</th>
													<th data-hide=""><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Action</th>
												</tr>
											</thead>
											<tbody>

                                            </tbody>
										</table>

									</div>
									<!-- end widget content -->
				
								</div>
								<!-- end widget div -->
				
							</div>
							<!-- end widget -->
				
						</article>
						<!-- WIDGET END -->
																				
					</div>
				
					<!-- end row -->
				
					<!-- end row -->
				
				</section>
				<!-- end widget grid -->

                <!-- Modal -->
				<div class="modal fade" id="show_photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title" id="prop_photo_title">Article Post</h4>
							</div>
							<div class="modal-body" id="photo_div">
				
								 
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
            		<!-- PAGE RELATED PLUGIN(S) -->
<script src="{{ asset('admin_assets/js/plugin/datatables/jquery.dataTables.min.js'); }}"></script>
<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.colVis.min.js'); }}"></script>
<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.tableTools.min.js'); }}"></script>
<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.bootstrap.min.js'); }}"></script>
<script src="{{ asset('admin_assets/js/plugin/datatable-responsive/datatables.responsive.min.js'); }}"></script>
<script>
			/* BASIC ;*/
    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;
    
    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };

    var oTable = $('#dt_basic').dataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "{{ url('/admin/get_all_property_posted_agent/') }}<?php echo '/'.$user_id; ?>", //{{ url('/admin/get_all_property_posted_agent/1') }} 
                    "method": "POST",
					"columns": [

							{data: 'title', name: 'title'},

							{data: 'created_at', name: 'created_at'},

							{data: 'action', name: 'action', orderable: false, searchable: false},

						],
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});

</script>

<script>
function show_photos(prop_id, title){

    $('#prop_photo_title').html(title+' Photos');
   
   $('#show_photo').modal('show');

    $.ajax({
        url: "{{ route('admin.get_photos_carousel');}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: "POST",
        data: { "property_id": prop_id},
        success: function(data){

            $('#photo_div').html(data);

        },
        error: function(err){

        }
    });
    
}    

$(document).ready(function(){

    $('.carousel.slide').carousel({
        interval : 3000,
        cycle : true
    });

    $('.carousel.fade').carousel({
        interval : 3000,
        cycle : true
    });

});

</script>
@include('admin.content.footer-new.footer-js-new')

@include('admin.content.footer-new.footer-last-new')