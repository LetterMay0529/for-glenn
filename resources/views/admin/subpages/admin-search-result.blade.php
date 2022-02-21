<h1 class="font-md"> Search Results for <span class="semi-bold">Agents</span><small class="text-danger"> &nbsp;&nbsp;(<?php echo number_format(count($result)); ?> results)</small></h1>
                
    <?php foreach($result as $data){ ?>

    <div class="search-results clearfix smart-form">

    <div class="row">
            <div class="col-md-3">
                <?php
                        $profile  = 'profile_img/avatar-agent.jpg';

                         if($data->profile_img != 'none'){
 
                             $profile = 'profile_img/'.$data->profile_img;
 
                         }
                ?>
                <img src="<?php echo asset($profile); ?>" class="img-responsive" alt="img" style="width: 90%;">
            </div>
            <div class="col-md-9 padding-left-0">
                <h1 class="margin-top-0"> <?php echo $data->firstname." ".$data->lastname; ?> <br><small class="font-xs"></small></h1>
                <br>
                <p><?php echo 'Username: '.$data->username; ?></p>
                <p><?php echo 'Email: '.$data->email; ?></p> 
                <?php 
                
                $acc_status = '';

                if($data->status == 'inactive'){
                    $stat = '<p style="color:red;">Deactivated</p> ';
                }

                if($data->status == 'active'){
                    $stat = '<p style="color:green;">Activated</p> ';
                }

                if($data->status == 'not_verified'){
                    $stat = '<p style="color:#05077d;">Not verified</p> ';
                }
                echo $stat; 
                
                ?>
                <?php if($data->status == 'active'){

                    echo '<p>Status: <span style="color: green;">'.ucwords($data->status).'</span></p>';

                }?>
                <br>
                <p><strong>About me..</strong> </br> 
                <?php echo nl2br(e($data->about_me)); ?></p> 
                </p></br> 
 
                <a href="/admin/view_property_agent_posted/<?php echo $data->users_id;?>"><button  class="btn btn-primary btn-sm" > View Agent </button></a>
                <!-- <button class="btn btn-success btn-sm" > <i class="fa fa-eye"> </i> Property Posted </button> -->
                <?php if($data->status == 'active'){
                    echo '<button class="btn btn-danger btn-sm" onclick="deactivate_active_agents('.$data->users_id.')"> Deactivate Account </button>';
                }?>
                <button class="btn btn-default btn-sm" onclick="reset_account(<?php echo $data->users_id;?>, <?php echo '\''.$data->firstname.'\'';?>, <?php echo '\''.$data->email.'\'';?>)"><i class="fa fa-key"> </i> Reset Password </button>
            </div>
        </div>

    </div>

    <?php } ?>
 

<div class="text-center">
<?php
            //$num_list = count($num_data);
            $num_list = 100;
            $num_list = $num_list / 10; 
            $pages = ceil($num_list);

            $prev = '';
            $next = '';

            if($pages <= 1){
                $prev = 'disabled';
                $next = 'disabled';
            }

            if( intval($request->offset) == 0){
                $prev = 'disabled';
                $prev_value = '\'disabled\'';
            }else{
                $prev_value = intval($request->offset) - 10;
            }

        ?>
    <hr>
    <ul class="pagination no-margin">
        
        <li class="prev <?php echo $prev; ?>">
        

            <a href="javascript:void(0);" id="prev_btn" onclick="new_pages(<?php echo $prev_value; ?>)">Previous</a>

        </li>

        <?php 
         $y = 0;
         $next_value = '';
        for($x=1; $x < $pages; $x++){

            $class = '';
            $pair = $x - 1;
            if($request->offset == $pair*10){
                $class = 'class="active"';
            }
            echo '<li '.$class.'>
                    <a href="javascript:void(0);"  onclick="new_pages('.$y.')">'.$x.'</a>
                </li>';
            $y += 10;   

            $verify_next =  intval($pages)-1;

            if( $request->offset == (($verify_next-1)*10)){

                $next = 'disabled';
                $next_value = '\'disabled\'';

            }else{

                $next_value = intval($request->offset) + 10;

            }

           
        }
        
        ?>
        <li class="next  <?php echo $next; ?>">
            <a href="javascript:void(0);" id="next_btn" onclick="new_pages(<?php echo $next_value; ?>)">Next</a>
        </li>
    </ul>
    <br>
    <br>
    <br>
</div>

<script>

    function new_pages(offset){

        if(offset == 'disabled'){

            console.log('button_disabled');

        }else{

            var status = $('#status_change').val(); 
            var search = $('#search-agent').val(); 

            ajax_query_agent(status, search, 1, offset);
        }

    }

    function deactivate_active_agents(agent_id){

        $('#deactivateModal').modal('show');

        $('input[name=deactivate_agent_id]').val(agent_id);

    }

	var $deactivate_form = $("#deactivate-form").validate({
	
    // Rules for form validation
    rules : {
        details_of_result : {
            required : true
        } 
    },

    // Messages for form validation
    messages : {
        details_of_result : {
            required : '<p style="color:red"> Please provide details of account deactivation. </p>'
        }
    },
    submitHandler : function(form) {

		$(form).ajaxSubmit({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success : function(res) {
                    if(res == 'SUCCESS'){

                        $.smallBox({
                            title : "Agent account successfully deactivated",
                            content : "<i class='fa fa-check-o'></i> <i>2 seconds ago...</i>",
                            color : "#739E73",
                            iconSmall : "fa fa-check bounce animated",
                            timeout : 4000
                        });

						search_press();
						$('#deactivateModal').modal('hide');


                    }else if(res == 'FAILED'){
                        
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

function reset_account(users_id, firstname, email){


    $.SmartMessageBox({
					title : "Reset Password",
					content : "Password reset sent to email.",
					buttons : '[No][Yes]'
				}, function(ButtonPressed) {
					if (ButtonPressed === "Yes") {

                        $.ajax({
                            "url": "<?php echo route('admin.reset_password'); ?>",
                            "method": "POST",
                            "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                            "data": {"user_id":users_id, "firstname": firstname, "email": email}, // rank 1 means query agents account only
                            success: function(data){ 

                                //$('#search-result-div').html(data);
                                $.smallBox({
                                        title : "Success",
                                        content : "<i class='fa fa-clock-o'></i> <i>Please check email for the auto generated password that you can use to login.</i>",
                                        color : "#659265",
                                        iconSmall : "fa fa-check fa-2x fadeInRight animated",
                                        timeout : 4000
                                    });

                            },
                            error: function(err){

                                console.log(err);

                            }
                        });
		
						
					} 
		
				});
}

</script>