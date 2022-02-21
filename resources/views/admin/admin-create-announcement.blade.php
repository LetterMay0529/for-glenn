@include('admin.content.header')
@include('admin.content.sidebar') 
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
            <li>Announcement</li><li>Create</li>
        </ol>
        <!-- end breadcrumb -->

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
        </span> -->

    </div>
    <!-- END RIBBON -->
    
    

    <!-- MAIN CONTENT -->
    <div id="content">

        <!-- row -->
        <div class="row">
            
            <!-- col -->
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-5">
                <h1 class="page-title txt-color-blueDark">
                    
                    <!-- PAGE HEADER -->
                    <i class="fa-fw fa fa-home"></i> 
                       Announcement
                    <span>>  
                        Create Announcement
                    </span>
                </h1>
            </div>
            <!-- end col -->
            

            
        </div>
        <!-- end row -->
        
        <!--
            The ID "widget-grid" will start to initialize all widgets below 
            You do not need to use widgets if you dont want to. Simply remove 
            the <section></section> and you can use wells or panels instead 
            -->
        
        <!-- widget grid -->
        <section class="well well-light">
        
            <!-- row -->
        
            <div class="row">
        
                <!-- a blank row to get started -->
                <div class="col-sm-12">
                    					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form id="create-announcement" method="POST" action="{{ route('admin.publish_announcement')}}" class="smart-form" novalidate="novalidate">
                            
							<fieldset>
                                
                                <section>
                                    <div class="inline-group">
                                        <label class="radio">
                                            <input type="radio" name="intended_to" value="agent_only" checked="">
                                            <i></i>All Agents Only</label>
                                    </div>
                                </section>

                                <section>
                                        <label class="input"> <i class="icon-prepend fa fa-pencil"></i>
                                            <input type="text" name="subject" placeholder="Subject">
                                        </label> 
                                </section>

								<section>
									<label class="textarea"> 										
										<textarea rows="10" name="content" placeholder="Content"></textarea> 
									</label>
								</section>

							</fieldset>

							<footer>
								<button type="submit" class="btn btn-primary" id="ann_btn">
									Send Announcement
								</button>
							</footer>
						</form>

					</div>
					<!-- end widget content -->
                </div>
                    
            </div>
        
            <!-- end row -->
        
        </section>
        <!-- end widget grid -->

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
@include('admin.content.footer-new.footer-js-new')

<!-- CUSTOM NOTIFICATION -->
<script src="{{ asset('admin_assets/js/notification/SmartNotification.min.js'); }}"></script>
<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>

<script>
    $(document).ready(function(){
        var $create_announcement = $("#create-announcement").validate({
	
    // Rules for form validation
    rules : {
        subject : {
            required : true
        },
        content : {
            required : true
        } 
    },

    // Messages for form validation
    messages : {
        subject : {
            required : '<p style="color:red">Subject is required!</p>'
        },
        content : {
            required :'<p style="color:red">Content is required!</p>'
        } 
    },
    submitHandler : function(form) {

        $(form).ajaxSubmit({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function() {  
                $('#ann_btn').text('Submitting ...');
                $('#ann_btn').prop('disabled', true);
            },
            success : function(res) {
                $('#ann_btn').text('Send Announcement');
                $('#ann_btn').prop('disabled', false);
                if(res == 'SUCCESS'){
                    $.smallBox({
                        title : "Announcement successfully created and sent.",
                        content : "<i class='fa fa-clock-o'></i> <i>2 seconds ago...</i>",
                        color : "#739E73",
                        iconSmall : "fa fa-check bounce animated",
                        timeout : 4000
                    });
                    $('#create-announcement')[0].reset();
                    // form.find('textarea,input,select').not('input[name="latitude"],input[name="longitude"]').val('');


                }else{
                    var json = $.parseJSON(res);
                    console.log(json.length);
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
@include('admin.content.footer-new.footer-last-new')