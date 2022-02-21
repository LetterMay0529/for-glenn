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
					<li>Agent</li><li>Agent Profile</li>
				</ol>
				<!-- end breadcrumb -->
			</div>
			<!-- END RIBBON -->
            <!-- MAIN CONTENT -->
            <div id="content">

                <!-- row -->
                
                <div class="row">
                
                    <div class="col-sm-12">
                
                    <div class="well well-light"  >
                                <h1> Search <span class="semi-bold">Agents</span></h1>
                                <br>
                                <form id="search-form" method="POST">
                                    <div class="input-group input-group-lg hidden-mobile">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="display_selected_btn">
                                                All <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="active" id="all_btn">
                                                    <a href="javascript:void(0)"> All Agents</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li  id="approve_btn">
                                                    <a href="javascript:void(0)"><label class="label label-success"><i class="fa fa-check"></i></label> Approved</a>
                                                </li>
                                                <li  id="deactivated_btn">
                                                    <a href="javascript:void(0)"><label class="label label-danger"><i class="fa fa-times"></i></label> Deactivated</a>
                                                </li>
                                                <li  id="pending_btn"> 
                                                    <a href="javascript:void(0)"><label class="label label-warning"><i class="glyphicon glyphicon-info-sign"></i></label> Pending</a>
                                                </li>
                                            </ul>
                                        </div> 
                                            <input type="hidden" name="status" value="all" id='status_change'>
                                            <input class="form-control input-lg" type="text" placeholder="Search again..." id="search-agent">
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-default" id='search_btn'>
                                                    &nbsp;&nbsp;&nbsp;<i class="fa fa-fw fa-search fa-lg"></i>&nbsp;&nbsp;&nbsp;
                                                </button>
                                            </div> 
                                    </div>
                                </form>
                                <div id="search-result-div">
                                </div>
                            </div>
                
                    </div>
                
                </div>
                
                <!-- end row -->

            </div>
    				<!-- START DEACTIVATE MODAL -->
                    <div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-remove-sign" style="color:red;"></i> Deactivate Agent</h4>
                                </div>
                                <form method="POST" action="{{ route('admin.deactivate_agents_accounts'); }}" id="deactivate-form">
                                    <div class="modal-body">
                        
                                        <div class="row">
                                            
                                            <div class="col-md-12"> 
                                            <p style="font-style: italic;text-align:center">"<strong>Note:</strong>Please thoroughly investigate agents's account before deactivating."</p>
                                                <br>
                                                <div class="form-group">
                                                    <input type="hidden" name="deactivate_agent_id" required>
                                                    <textarea class="form-control" placeholder="Reason for deactivation [required].. " rows="5" name="details_of_result" id="details_of_result" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-danger">
                                            Deactivate Agents
                                        </button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <!-- END DEACTIVATE MODAL -->
</div>
<!-- END MAIN CONTENT -->

@include('admin.content.footer-new.footer-js-new')
<script>
    
    $(document).ready(function(){
        
            var status = $('#status_change').val(); 
            var search = $('#search-agent').val(); 

           ajax_query_agent(status, search, 1, 0);


        $('#all_btn').on('click', function(){

            $('#display_selected_btn').html('All <span class="caret"></span>');
            $('#status_change').val('all');

        });
        $('#approve_btn').on('click', function(){

            $('#display_selected_btn').html('Approved Agents <span class="caret"></span>'); 
            $('#status_change').val('active');

        });
        $('#deactivated_btn').on('click', function(){

            $('#display_selected_btn').html('Deactivated Agents <span class="caret"></span>');
            $('#status_change').val('deactivated');

        });
        $('#pending_btn').on('click', function(){

            $('#display_selected_btn').html('Pending Agents <span class="caret"></span>'); 
            $('#status_change').val('not_verified');

        });

//======== START SUBMIT DATA FOR SEARCH ==============
       $search_press =  $('#search-form').on('submit', function(event){

           var status = $('#status_change').val(); 
           var search = $('#search-agent').val(); 

           ajax_query_agent(status, search, 1, 0);
            
           event.preventDefault();
           
        });
//======== END SUBMIT DATA FOR SEARCH ==============
    });

function ajax_query_agent(status, search, rank, offset){

    $('#search-result-div').html('<p style="text-align:center;margin-top:30px;">Please wait while system is loading ... </p>');

    $.ajax({
        "url": "<?php echo route('admin.agent_search_result'); ?>",
        "method": "POST",
        "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
        "data": {"status_change":status, "search": search, "rank": rank, 'offset': offset}, // rank 1 means query agents account only
        success: function(data){ 

            $('#search-result-div').html(data);

        },
        error: function(err){

            console.log(err);

        }
    });

}

</script>
@include('admin.content.footer-new.footer-last-new')