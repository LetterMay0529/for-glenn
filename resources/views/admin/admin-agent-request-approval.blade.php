@include('admin.content.header')
@include('admin.content.sidebar') 

<style>
    ul li p{
        padding: 0px;
        margin: 0px;
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
					<li>Agent</li><li>Request for Approval</li>
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
									Request for Approval
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
                                <div class="well well-light no-paddings">
                                    <table id="dt_apt" class=" table table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr> 
                                                <th data-class="expand" style="width:60%;"><i class="fa fa-fw fa-users text-muted hidden-md hidden-sm hidden-xs"></i> Agent' Name</th> 
                                                <th data-hide="phone,tablet " style="width:20%;"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date of Request for Review</th>
                                                <th data-hide="" style="width:20%;"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Action</th>
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

    var oTable = $('#dt_apt').dataTable({
        "processing": true,
        "serverSide": true, 
        "ajax": "{{ route('admin.get_all_pending_review'); }}",
        "columns": [

            {data: 'agent_name', name: 'agent_name'}, 

            {data: 'date_requested', name: 'date_requested'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
    });			
 
</script>
<!-- CUSTOM NOTIFICATION -->
<script src="{{ asset('admin_assets/js/notification/SmartNotification.min.js'); }}"></script> 
		<!-- JQUERY VALIDATE -->
<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>


@include('admin.content.footer-new.footer-js-new')
@include('admin.content.footer-new.footer-last-new')

