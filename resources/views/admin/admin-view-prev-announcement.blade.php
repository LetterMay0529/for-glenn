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
					<li>Announcement</li><li>Announcement List</li>
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
									Announcement
								<span>>  
                                    Previous Announcement List
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
                                                    <th width="15%">Date</th>  
                                                    <th width="25%">Subject</th>  
                                                    <th width="40%">Details</th>
                                                    <th width="10%">Intended To</th>
                                                    <th width="10%">Announced By (Admin)</th>
                                                    <th width="10%">Action</th>
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
                    <div class="modal fade" id="viewAnnouncentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-microphone"> </i> Announcement Details</h4>
                                </div>
                                <div class="modal-body" id="announcement_body">
                    
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

            function removeAnnouncement(ann_id){

                $.SmartMessageBox({
					title : "Smart Alert!",
					content : "This is a confirmation box. Can be programmed for button callback",
					buttons : '[No][Remove]'
				}, function(ButtonPressed) {
					if (ButtonPressed === "Remove") {
		
                        $.ajax({
                            url: "{{ route('admin.removeAnnouncement'); }}",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            method: "POST",
                            data: {'announcement_id': ann_id},
                            success: function(res){
                                if(res == 'SUCCESS'){
                                    $.smallBox({
                                            title : "Announcement was removed!",
                                            content : "<i class='fa fa-clock-o'></i> <i>You pressed Yes...</i>",
                                            color : "#659265",
                                            iconSmall : "fa fa-check fa-2x fadeInRight animated",
                                            timeout : 4000
                                        });
                                        oTable.api().ajax.reload();
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
                        })
						
					} 
		
				});

            }

            function viewAnnouncement(ann_id){

                $('#viewAnnouncentModal').modal('show');

                $('#announcement_body').html('<div style="margin-top:50px; margin-bottom:50px;"><center><img src="<?php echo asset('admin_assets/img/ajax-loader.gif'); ?>"></center></div>');

                $.ajax({
                    url: "{{ route('admin.show_announcement_by_id'); }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    data: {'announcement_id': ann_id},
                    success: function(res){
                        
                            $('#announcement_body').html(res);

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
            "ajax": "{{ route('admin.announcement_list'); }}",
            "columns": [

                    {data: 'created_at', name: 'created_at'},

                    {data: 'subject', name: 'subject'},

                    {data: 'content', name: 'content'},

                    {data: 'intended_to', name: 'intended_to'},

                    {data: 'published_by', name: 'published_by'}, 

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

