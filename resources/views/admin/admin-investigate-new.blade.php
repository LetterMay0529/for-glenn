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
					<li>Admin</li><li>Investigation Request</li><li> <?php echo ucwords($status); ?> Request List</li>
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
								<?php echo ucwords($status); ?> Request List
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
                                                    <th style="width:20%;">Property Photo</th>  
                                                    <th>Property Details</th> 
                                                    <th style="width:5%;">Action</th>
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
										<h4 class="modal-title" id="myModalLabel"><i class="fa fa-save"> </i> Properties Save by Seeker</h4>
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
					"ajax": "/admin/view_request_all/<?php echo $status; ?>",
					"columns": [

                            {data: 'prop_img', name: 'prop_img'},

							{data: 'title', name: 'title'}, 
 
							{data: 'action', name: 'action', orderable: false, searchable: false},

						]
				});
</script>
@include('admin.content.footer')

