@include('seekers.layouts.header') 
<div class="page-head"> 
    <div class="container">
        <div class="row">
            <div class="page-head-content">
                <h1 class="page-title">Hello : <span class="orange strong"><?php echo ucwords(auth()->user()->firstname.' '.auth()->user()->lastname); ?></span></h1>               
            </div>
        </div>
    </div>
</div>
<!-- End page header --> 

<!-- property area -->
    <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
        <div class="container">   
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 profiel-container">

                        <div class="profiel-header">
                            <h3>
                                <b>UPDATE</b> YOUR PROFILE <br>
                                <small>This information will let us know more about you.</small>
                            </h3>
                            <hr>
                        </div>

                        <div class="clear">
                            <div class="col-sm-3 col-sm-offset-1">
                                <div class="picture-container">
                                    <form method="POST" action="{{ route('seeker.update_profile_img'); }}" enctype="multipart/form-data" id="form_profile_img">
                                        <div class="picture">
                                                    <?php 
                                                        
                                                        if(auth()->user()->profile_img == 'none'){
                                                                $img = asset('profile_img/avatar-agent.jpg');
                                                        }else{
                                                            $img = asset('profile_img/'.auth()->user()->profile_img);
                                                        }

                                                    ?> 
                                            <img src="{{ $img }}" class="picture-src" id="profilePreview" title="" style="height: 230px;object-fit: cover; "/>
                                            <input type="file" id="profile_select" name="profilePhoto" accept="image/png, image/gif, image/jpeg" >
                                        </div>
                                        <h6>Choose Picture</h6>
                                        <div class=" " id="uploadProfilebtn" style="text-align:center;  margin-bottom: 10px; display:none; "> 
                                            <input type="submit" class="btn btn-sm btn-success" value="Upload Profile Photo">
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            <form id="update_form" action="{{ route('seeker.update_user_information'); }}" method="POST"> 
                                <div class="col-sm-3 padding-top-25">
                                                                
                                    <div class="form-group">
                                        <label>First Name <small>(required)</small></label>
                                        <input name="firstname" value="<?php echo auth()->user()->firstname; ?>" type="text" class="form-control" placeholder="Firstname...">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name <small>(required)</small></label>
                                        <input name="lastname" type="text" class="form-control" value="<?php echo auth()->user()->lastname; ?>"  placeholder="Lastname...">
                                    </div>  
                                </div>
                                <div class="col-sm-3 padding-top-25">
                                    <div class="form-group">
                                        <label>Date of Birth : <small>(required)</small></label>
                                        <input name="date_of_birth" type="date" value="<?php echo auth()->user()->date_of_birth; ?>" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control" >
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        </br> 
                                        <button type="submit" class="btn btn-sm btn-primary" style="float: left;" id="update_profile_info_btn">Update Information</button>
                                    </div> 
                                </div>  
                            </form>
                        </div>

                        <form method="POST" action="{{ route('seeker.update_email'); }}" id="email-form">
                            @csrf
                            <div class="clear">
                                <br>
                                <hr>
                                <br>
                                <div class="col-sm-12">
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group">
                                            <label>Email <small>(required)</small></label>
                                            <input name="email" type="email"  value="<?php echo auth()->user()->email; ?>" class="form-control" placeholder="andrew@email@email.com.com">
                                        </div> 
                                    </div> 
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label></label>
                                            </br>
                                            <input type='submit' style="margin-top:5px;" class='btn btn-finish btn-primary' id='changeEmailBtn' name='submit' value='Update' />
                                        </div> 
                                    </div> 
                                   
                                </div>
                            </div> 
                        </form>

                        <form method="POST" action="{{ route('seeker.update_username'); }}" id="username-form" >
                            @csrf
                            <div class="clear">
                                <br>
                                <hr>
                                <br>
                                <div class="col-sm-12">
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group">
                                            <label>Username <small>(required)</small></label>
                                            <input name="username" type="text"  value="<?php echo auth()->user()->username; ?>" class="form-control" placeholder="andrew@email@email.com.com">
                                        </div> 
                                    </div> 
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label></label>
                                            </br>
                                            <input type='submit' style="margin-top:5px;" class='btn btn-finish btn-primary' id='changeUserBtn' name='submit' value='Update' />
                                        </div> 
                                    </div> 
                                   
                                </div>
                            </div> 
                        </form>
                    
                        <form method="POST" action="{{ route('seeker.change_password'); }}" id="password-form">
                            @csrf
                            <div class="clear">
                                <br>
                                <hr>
                                <br>
                                
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group">
                                        <label>Password :</label>
                                        <input name="password" type="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>  

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Confirm Password :</label>
                                        <input name="passwordConfirm" type="password"  class="form-control" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-sm-5 col-sm-offset-1">
                                <br>
                                <input type='submit' class='btn btn-finish btn-primary' id='submit_pass_update' name='submit' value='Change Password' />
                            </div> 
                        </form>
                        <br>
               

            </div>
        </div><!-- end row -->

    </div>
</div>

@include('seekers.layouts.footer')

<script>

$('#profile_select').on('change',function(e){

//console.log(this.value);
if(e.target.value == null || e.target.value == ''){

    $('#uploadProfilebtn').show('false');

}else{

    $('#uploadProfilebtn').show('true');

}

});

$('#form_profile_img').on('submit',(function(e) {

        e.preventDefault();

        var formData = new FormData(this);
 
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){

                if('SUCCESS'){
                    Swal.fire(
                        'New profile picture successfully uploaded!',
                        'You clicked the button!',
                        'success'
                    )
                }else{
                    Swal.fire(
                        'Sorry!',
                         data,
                        'error'
                    )
                }
                
               
                $('#uploadProfilebtn').hide();
                console.log(data);
            },
            error: function(data){
                $.smallBox({
                    title : "FAILED!",
                    content : 'Image upload error',
                    color : "#C46A69",
                    iconSmall : "fa fa-times bounce animated",
                    timeout : 4000
                });
            }
        });

    }));

profile_select.onchange = evt => {
            const [file] = profile_select.files
    
            if (file) {
                profilePreview.src = URL.createObjectURL(file)
            }
}

$("#email-form").validate({
    rules : {
        email:{
            required: true,
            email: true,
        }  
    },
    messages : { 
        email:{
            required: '<p style="color:red">Email is required!</p>',
            email: '<p style="color:red">Please provide a VALID email address!</p>'
        } 
    },
    submitHandler  : function(form){

        $.ajax({
                    url: form.action,
                    type: form.method,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: $(form).serialize(), 
                    beforeSend: function() { 
                        document.getElementById('changeEmailBtn').value = 'Updating ...';  
                        $('#changeEmailBtn').prop('disabled', true);
                    },
                    success : function(res) {

                        if(res == 'SUCCESS'){
                            Swal.fire(
                                'Email was successfully changed!',
                                'You clicked the button!',
                                'success'
                            )
                        }else{
                            Swal.fire(
                                'Sorry!',
                                res,
                                'error'
                            )
                        }
                        

                        document.getElementById('changeEmailBtn').value = 'Update';  
                        $('#changeEmailBtn').prop('disabled', false);
                    
                    }
        });
        
    }
});

$("#username-form").validate({
    rules : {
        username:{
            required: true, 
        }  
    },
    messages : { 
        username:{
            required: '<p style="color:red">Username is required!</p>', 
        } 
    },
    submitHandler  : function(form){

        $.ajax({
                    url: form.action,
                    type: form.method,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: $(form).serialize(), 
                    beforeSend: function() { 
                        document.getElementById('changeUserBtn').value = 'Updating ...';  
                        $('#changeUserBtn').prop('disabled', true);
                    },
                    success : function(res) {

                        if(res == 'SUCCESS'){
                            Swal.fire(
                                'Username was successfully changed!',
                                'You clicked the button!',
                                'success'
                            )
                        }else{
                            Swal.fire(
                                'Sorry!',
                                res,
                                'error'
                            )
                        }
                        

                        document.getElementById('changeUserBtn').value = 'Update';  
                        $('#changeUserBtn').prop('disabled', false);
                    
                    }
        });
        
    }
});
$("#password-form").validate({
     // Rules for form validation
     rules : {
        
        password : {
            required : true,
            minlength : 6, 
            maxlength : 20
        },
        passwordConfirm : {
            required : true,
            minlength : 6,
            maxlength : 20,
            equalTo : '#password'
        }

    },

    // Messages for form validation
    messages : {
        
        password : {
            required : '<p style="color:red;">Please enter your password!</p>', 
        },
        passwordConfirm : {
            required : '<p style="color:red;">Please enter your password one more time!</p>',
            equalTo : '<p style="color:red;">Please enter the same password as above!</p>', 
        }
    },
    submitHandler : function(form){
 
                    $.ajax({
                    url: form.action,
                    type: form.method,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: $(form).serialize(), 
                    beforeSend: function() { 
                        document.getElementById('submit_pass_update').value = 'Updating ...';  
                        $('#changePassBtn').prop('disabled', true);
                    },
                    success : function(res) {

                        if(res == 'SUCCESS'){

                            Swal.fire(
                                'Good job!',
                                'Password updated!',
                                'success'
                            );

                            document.getElementById('submit_pass_update').value = 'Change Password';  
                            $('#submit_pass_update').prop('disabled', false);

                            $(form)[0].reset();

                        }else{

                            Swal.fire(
                                'Good job!',
                                'Password updated!',
                                'success'
                            );


                        }
                        

                    }
                });

    }
});

$("#update_form").validate({
    rules: {
        firstname:{
            required: true, 
        }, 
        lastname:{
            required: true, 
        },
        gender:{
            required: true, 
        },
        date_of_birth:{
            required: true, 
        } 
    },
    messages:{
        firstname:{
            required: '<p style="color:red">Firstname is required!</p>', 
        }, 
        lastname:{
            required: '<p style="color:red">Lastname is required!</p>', 
        },
        gender:{
            required: '<p style="color:red">Gender is required!</p>', 
        }, 
        date_of_birth:{
            required: '<p style="color:red">Date of Birth is required!</p>', 
        } 
    },
    submitHandler: function(form) {

        $.ajax({
            url: form.action,
            type: form.method,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: $(form).serialize(),
            beforeSend: function() { 
                $('#update_profile_info_btn').text('Submitting ...');  
                $('#update_profile_info_btn').prop('disabled', true);
            },
            success : function(res) {

                if(res == 'SUCCESS'){ 

                        Swal.fire(
                            'Good job!',
                            'Profile information updated!',
                            'success'
                        );
  
                }else{

                    var json = $.parseJSON(res); 
                    var contents='';

                    // $.each(json, function(index, element) {
                    //     //console.log(element);

                    // }); 

                    console.log(json);

                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR : FAILED TO UPDATE!',
                        text: res, 
                    })
                }

                $('#update_profile_info_btn').text('Update Information');  
                $('#update_profile_info_btn').prop('disabled', false);
                
            }           
        });

    }

});
</script>

</body>
</html>