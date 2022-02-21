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
					<li>Admin</li><li>Seekers List</li>
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
									Agent
								<span>>  
                                    Seekers List
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

                                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="width:30px">Pic</th>
                                                    <th>Fullname</th>  
                                                    <th>Date of Birth</th>
                                                    <th>Email</th>
                                                    <th>Username</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
											<tbody>
												
											</tbody>
										</table>
								 
				
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
										<h4 class="modal-title" id="myModalLabel"><i class="fa fa-save"> </i> Properties Save by Seekers</h4>
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

		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="{{ asset('admin_assets/js/plugin/datatables/jquery.dataTables.min.js'); }}"></script>
		<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.colVis.min.js'); }}"></script>
		<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.tableTools.min.js'); }}"></script>
		<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.bootstrap.min.js'); }}"></script>
		<script src="{{ asset('admin_assets/js/plugin/datatable-responsive/datatables.responsive.min.js'); }}"></script>
		<script>
			$(document).ready(function(){

            });

            function reset_account(users_id, firstname, email){

					$('#reset_btn_'+users_id).html(' <span class="btn-label"><i class="fa fa-key"></i></span> Submitting... ');
					$('#reset_btn_'+users_id).prop('disabled', true);
						$.SmartMessageBox({
							title : "Reset Password?",
							content : "By clicking \'YES\', the customer password will be updated and a new auto-generated password will be sent to Seekers\'s email.",
							buttons : '[Cancel][Continue]'
						}, function(ButtonPressed) {

							if (ButtonPressed === "Continue") {

								$.ajax({
									"url": "<?php echo route('admin.reset_password'); ?>",
									"method": "POST",
									"headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
									"data": {"user_id":users_id, "firstname": firstname, "email": email}, // rank 1 means query agents account only
									success: function(data){ 

										$('#reset_btn_'+users_id).html('<span class="btn-label"><i class="fa fa-key"></i></span> Reset');
										$('#reset_btn_'+users_id).prop('disabled', false);
										$.smallBox({
											title : "Success",
											content : "<i class='fa fa-clock-o'></i> <i>Please check email for the auto generated password that you can use to login.</i>",
											color : "#659265",
											iconSmall : "fa fa-check fa-2x fadeInRight animated",
											timeout : 4000
										});

									},
									error: function(err){

										alert('Error: '+err);

									}
								});
				
							
							}else{
								$('#reset_btn_'+users_id).html('<span class="btn-label"><i class="fa fa-key"></i></span> Reset');
								$('#reset_btn_'+users_id).prop('disabled', false);
							}
				
						});
			}

			function saveProperties(users_id){

				$('#savePropModal').modal('show');
				$.ajax({
					"url": "<?php echo route('admin.view_properties_table'); ?>",
					"method": "POST",
					"headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
					"data": {"customer_id":users_id}, // rank 1 means query agents account only
					success: function(data){ 
						
						$('#savePropModalbody').html(data); 

					},
					error: function(err){

						console.log(err);

					}
				});

			}
		</script>
	
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
                //var oTable = $('#dt_basic').dataTable();
				var oTable = $('#dt_basic').dataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "{{ route('admin.show_customer_record'); }}",
					"columns": [

                            {data: 'profile_img', name: 'profile_img'},

							{data: 'firstname', name: 'firstname'},

							{data: 'date_of_birth', name: 'date_of_birth'},

							{data: 'email', name: 'email'}, 

                            {data: 'username', name: 'username'}, 

                            {data: 'phone', name: 'phone'}, 

                            {data: 'status', name: 'status'}, 

							{data: 'action', name: 'action', orderable: false, searchable: false},

						],
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
						"t"+"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
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
@include('admin.content.footer')

