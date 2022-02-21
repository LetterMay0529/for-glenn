@include('admin.content.header')
@include('admin.content.sidebar')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


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
					<li>Agent</li><li>Dashboard</li>
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
									Add Appointment
								</span>
							</h1>
						</div>
						
					</div>

					

					<!-- widget grid -->
					<section id="widget-grid" class="">
						<!-- START ROW -->

						<div class="row">
                            <!-- NEW COL START -->
                            <article class="col-sm-12 col-md-12 col-lg-6">
                                <!-- Widget ID (each widget will need unique ID)-->
                                <div class="jarviswidget" id="wid-id-3" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-building"></i> </span>
                                        <h2> Appointment </h2>
                                    </header>
                    
                                    <!-- widget div-->
                                    <div>
                                        <!-- widget edit box -->
                                        <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->
                                        </div>
                                        <!-- end widget edit box -->
                    
                                        <!-- widget content -->
                                        <div class="widget-body">
                    
                                        <!-- widget content -->
                                        <div class="widget-body no-padding">
                                            <form class="smart-form" id="create_apt_form" action="{{ route('agent.create_apt_insert');}}" method="POST">
                                                <header>
                                                    Create Business Appointment
                                                </header>

                                                <fieldset class="state-error">
                                                    <section >
                                                        <label class="label">Select Client</label>
                                                        <select style="width:100%" class="select2 " id="seeker_field" name="client_id"></select>
                                                    </section>
                                                </fieldset>

                                                <fieldset>
                                                    <section>
                                                        <label class="label">Select Properties</label>
                                                        <select style="width:100%" class="select2" id="property_selected" name="prop_id"></select>
                                                    </section>
                                                </fieldset>
                            
                                                <fieldset>
                                                    <section>
                                                        <label class="label">Message Description</label>
                                                        <label class="textarea "> 										
                                                            <textarea rows="5" class="custom-scroll" id="message_desc" name="message_desc"></textarea> 
                                                        </label>
                                                        <div class="note">
                                                            <strong>Note:</strong> expands on focus.
                                                        </div>
                                                    </section>
                                                </fieldset>

                                                <fieldset>
                                                    <section>
                                                    <label class="label">Set Time and Date</label>
                                                        <div class="form-group"> 
                                                            <div class="input-group">
                                                                <input type="text" name="date_apt" placeholder="Select a date" class="form-control" readonly id="datetimepicker" >
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group"> 
                                                                <div class="input-group">
                                                                    <input class="form-control" id="timepicker" type="text" name="time_apt" readonly placeholder="Select time">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>
                                                        </div>
                                                    </section>
                                                </fieldset>
                                                

                                                <footer>
                                                    <button type="submit" class="btn btn-primary" id="apt_create_id_btn">
                                                        Submit
                                                    </button>
                                                    <button type="button" class="btn btn-default" onclick="window.history.back();">
                                                        Back
                                                    </button>
                                                </footer>
                                            </form>
                                        </div>
                                        <!-- end widget content -->
                    
                                        </div>
                                        <!-- end widget content -->
                    
                                    </div>
                                    <!-- end widget div -->
                    
                                </div>
                                <!-- end widget -->
                            </article>
                            <!-- END COL -->
                            <!-- NEW COL START FOR APPOINTMENT CREATED -->
                            <article class="col-sm-12 col-md-12 col-lg-6">
                                <div class="jarviswidget" id="wid-id-3" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                                        <h2> Appointments Created </h2>
                                    </header>
                                        <!-- widget div-->
                                        <div>
                                        <!-- widget edit box -->
                                        <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->
                                        </div>
                                        <!-- end widget edit box -->
                    
                                        <!-- widget content -->
                                        <div class="widget-body">
                                            <div class="widget-body ">
                                                <table id="dt_apt" class=" table table-striped table-bordered table-hover" width="100%">
                                                    <thead>			                
                                                        <tr> 
                                                            <th data-class="expand" style="width:30%;"><i class="fa fa-fw fa-users text-muted hidden-md hidden-sm hidden-xs"></i> Client Name</th>
                                                            <th data-hide="phone,tablet,web" style="width:30%;"><i class="fa fa-fw fa-building text-muted hidden-md hidden-sm hidden-xs"></i> Property</th>
                                                            <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date of Meeting</th>
                                                            <th data-hide=""><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Operation</th>
                                                        </tr>
 
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end widget content -->
                    
                                        </div>
                                        <!-- end widget div -->
                                    </div>
                            </article>
                            <!-- END COL  FOR APPOINTMENT CREATED-->
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


<script src="{{ asset('admin_assets/js/plugin/select2/select2.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/maxlength/bootstrap-maxlength.min.js'); }}"></script>
<script src="{{ asset('admin_assets/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js'); }} "></script>
<script src="{{ asset('admin_assets/js/plugin/clockpicker/clockpicker.min.js'); }} "></script>

		
<script> 

$(document).ready(function(){
   
    var $create_apt_form = $("#create_apt_form").validate({
	
    // Rules for form validation
    rules : {
        client_id : {
            required : true
        },
        prop_id : {
            required : true
        },
        message_desc:{
            required : true
        },
        date_apt : {
            required : true
        },
        time_apt : {
            required : true
        }
    },

    // Messages for form validation
    messages : {
        client_id : {
            required : '<p style="color:red">Please choose client to meet with.</p>'
        },
        prop_id : {
            required : '<p style="color:red">Please select property</p>'
        },
        message_desc: {
            required : '<p style="color:red">This is required.</p>',
        },
        date_apt : {
            required : '<p style="color:red">Please date of meeting</p>', 
        },
        time_apt : {
            required : '<p style="color:red">Please time of meeting</p>', 
        }
    },
    submitHandler : function(form) {

      
        if($('#property_selected').val() == null || $('#seeker_field').val() == null){

           
            

            if($('#seeker_field').val() == null || $('#seeker_field').val() == ''){
                    $.smallBox({
                    title : "Error",
                    content : 'Please selected a client to meet with',
                    color : "#C46A69",
                    iconSmall : "fa fa-times bounce animated",
                    timeout : 4000
                });
                document.getElementById('select2-seeker_field-container').parentNode.setAttribute("style", "border: 1px solid red;");
            }else{
                document.getElementById('select2-seeker_field-container').parentNode.removeAttribute("style");
            }

            

            if($('#property_selected').val() == null || $('#property_selected').val() == ''){
                    $.smallBox({
                    title : "Error",
                    content : 'Please selected a property to discuss with client',
                    color : "#C46A69",
                    iconSmall : "fa fa-times bounce animated",
                    timeout : 4000
                });
                document.getElementById('select2-property_selected-container').parentNode.setAttribute("style", "border: 1px solid red;");
            }else{
                document.getElementById('select2-property_selected-container').parentNode.removeAttribute("style");
            }
            

        }else{

            document.getElementById('select2-seeker_field-container').parentNode.removeAttribute("style");
            document.getElementById('select2-property_selected-container').parentNode.removeAttribute("style");

            $(form).ajaxSubmit({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function() { 
                    document.getElementById('apt_create_id_btn').value = 'Submitting ...';  
                    $('#apt_create_id_btn').prop('disabled', true);
                },
                success : function(res) {

                    document.getElementById('apt_create_id_btn').value = 'Submit';  
                    $('#apt_create_id_btn').prop('disabled', false);

                    if(res == 'SUCCESS'){
                        $.smallBox({
                            title : "Appointment was successfully created!",
                            content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
                            color : "#739E73",
                            iconSmall : "fa fa-check bounce animated",
                            timeout : 4000
                        });

                        $("#property_selected").empty();
                        $("#select2-property_selected-container").text('');
                        $("#select2-seeker_field-container").text(''); 
                        $("#seeker_field").empty(); 
                        $('textarea#message_desc').val('');

                        //reload datatables
                        oTable.api().ajax.reload();

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
        }
            
        }, 
    // Do not change code below
        errorPlacement : function(error, element) {
            error.insertAfter(element.parent());
        }
    });
});



var token = $('meta[name="csrf-token"]').attr('content');

    $('#seeker_field').select2({
            ajax:{
                url: "{{ route('agent.query_active_seekers'); }}",
                type: "POST",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        _token: token, 
                        search: params.term, // search term
                    };
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    var results = [];

                    $.each(data, function(k, v) {
                        
                        if(v.profile_img == 'none'){
                            var temp_img = "{{ asset('admin_assets') }}"+'/img/avatars/male.png';
                        }else{
                            var temp_img = "{{ asset('profile_img/') }}"+v.profile_img;
                        }
                        
                        
                        results.push({
                            id: v.users_id,
                            text: v.firstname + ' '  +v.lastname,
                            image: temp_img
                        });
                    });

                    //console.log(data);
                    return {
                        results: results
                    };
                },
                cache: true
            },
            placeholder: 'Search for a client',
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });

        function formatRepo (repo) {
    if (repo.loading) {
        return repo.text;
    }

    var $container = $(
        '<li class="message message-reply">'+
        '<img src="'+repo.image+'" style="width: 70px" class="online" alt="user">'+
        '<span class="message-text" style="margin-left:15px; margin-right:15px;">'+repo.text+' </span></li>'
    );
        return $container;
    }

function formatRepoSelection (repo) {
  return repo.firstname || repo.text;
  
}

    $('#property_selected').select2({
        ajax:{
            url: "{{ route('agent.query_active_properties'); }}",
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    _token: token, 
                    search: params.term, // search term
                };
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                var results1 = [];

                $.each(data, function(k, v) {
                    
                    if(v.prop_img == 'none'){
                        var temp_img = "{{ asset('admin_assets') }}"+'/img/avatars/male.png';
                    }else{
                        var temp_img = "{{ asset('property_img') }}"+'/'+v.prop_img;
                    }
                    
                    results1.push({
                        id: v.property_id,
                        text: v.title,
                        image: temp_img,
                        description: v.description
                    });
                });

                //console.log(data);
                return {
                    results: results1
                };
            },
            cache: true
        },
        placeholder: 'Search for a properties',
        minimumInputLength: 1,
        templateResult: formatRepo1,
        templateSelection: formatRepoSelection1
    });

    function formatRepo1 (repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<li class="message message-reply">'+
            '<img src="'+repo.image+'" style="width: 70px" class="online" alt="user">'+
            '<span class="message-text" style="margin-left:15px; margin-right:15px;">'+repo.text+' </span></li>'
        );

        
        return $container;
        }

    function formatRepoSelection1 (repo) {
    return repo.title || repo.text;
    }
    
    var dateToday = new Date();

    var dateToday = new Date();
    var dates = $("#datetimepicker").datepicker({
        defaultDate: '+1',
        changeMonth: true,
        numberOfMonths: 1,
        minDate: dateToday
    });

    
    $('#timepicker').timepicker();

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
	
				var oTable = $('#dt_apt').dataTable({
					"processing": true,
					"serverSide": true, 
					"ajax": "{{ route('agent.view_apt_ajax'); }}",
					"columns": [

                        {data: 'client_name', name: 'client_name'},

                        {data: 'property', name: 'property'},

                        {data: 'date_scheduled', name: 'date_scheduled'},

                        {data: 'action', name: 'action', orderable: false, searchable: false},

                        ]
				});

 function remove_apt(id){ 
 
 $.SmartMessageBox({
     title : "Remove Appointment!",
     content : "Are you sure you wanted to remove this appointment created?",
     buttons : '[No][Yes]'
 }, function(ButtonPressed) {
     if (ButtonPressed === "Yes") {

         $.ajax({
             url: "{{ route('agent.remove_appointment'); }}",
             method: "POST",
             cache: false,
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             data : {'apt_id': id},
             success: function(data){

                 $.smallBox({
                     title : "Appointment Deleted",
                     content : "<i class='fa fa-check'></i> <i>File successfully remove</i>",
                     color : "#659265",
                     iconSmall : "fa fa-check fa-2x fadeInRight animated",
                     timeout : 4000
                 });

                 oTable.api().ajax.reload();

             }
         });
         
     } 

 }); 



 }
</script>
<!-- CUSTOM NOTIFICATION -->
<script src="{{ asset('admin_assets/js/notification/SmartNotification.min.js'); }}"></script> 
		<!-- JQUERY VALIDATE -->
<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>


@include('admin.content.footer')

