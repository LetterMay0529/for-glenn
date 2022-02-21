@include('seekers.layouts.header') 
<div class="page-head"> 
    <div class="container">
        <div class="row">
            <div class="page-head-content">
                <h1 class="page-title">Create New Account</h1>               
            </div>
        </div>
    </div>
</div>
<!-- End page header -->


<!-- register-area -->
<div class="register-area" style="background-color: rgb(249, 249, 249);">
    <div class="container">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="box-for overflow">
                <div class="col-md-12 col-xs-12 register-blocks">
                    <h2>New account : </h2> 
                    <form id="create_form" action="{{ route('seeker.sign_up_seeker')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                        </div>
                        <div class="form-group">
                            <label for="name">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                        </div>
                       
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" >
                                <option value="Male">Male</option>
                                <option value="Female">Female</option> 
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" class="form-control"  name="date_of_birth">
                        </div>

                        <div class="form-group">
                            <label >Phone</label>
                            <input  type="tel" class="form-control" id="phone" name="phone" data-mask="(999) 999-9999" >
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-default" style="width:100%;" id="register_btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 

    </div>
</div>
@include('seekers.layouts.footer')

<script>
 $(document).ready(function() {

    // $('#phone_us').mask('0000-0000');

    $("#create_form").validate({
            rules: {
                firstname:{
                    required: true, 
                },
                middlename:{
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
                },
                phone:{
                    required: true, 
                },
                username:{
                    required: true, 
                },
                email:{
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                    pwcheck: true,
                }
            },
            messages:{
                firstname:{
                    required: '<p style="color:red">Firstname is required!</p>', 
                },
                middlename:{
                    required: '<p style="color:red">Middlename is required!</p>', 
                },
                lastname:{
                    required: '<p style="color:red">Lastname is required!</p>', 
                },
                gender:{
                    required: '<p style="color:red">Gender is required!</p>', 
                },
                phone:{
                    required: '<p style="color:red">Phone is required!</p>', 
                },
                date_of_birth:{
                    required: '<p style="color:red">Date of Birth is required!</p>', 
                },
                username:{
                    required: '<p style="color:red">Username is required!</p>', 
                },
                email:{
                    required: '<p style="color:red">Email is required!</p>',
                    email: '<p style="color:red">Please provide a VALID email address!</p>'
                },
                password:{
                    required: '<p style="color:red">Password is required!</p>', 
                    minlength: '<p style="color:red">Minimum character is 6</p>',
                    pwcheck: '<p style="color:red">Password must contain a lower case, digits and a punctuation marks!</p>'
                }
            },
            submitHandler: function(form) {

                $.ajax({
                    url: form.action,
                    type: form.method,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: $(form).serialize(),
                    beforeSend: function() { 
                        $('#register_btn').text('Logging in ...');  
                        $('#register_btn').prop('disabled', true);
                    },
                    success : function(res) {

                        if(res == 'SUCCESS'){

                            setTimeout(function(){ 

                                Swal.fire(
                                    'Good job!',
                                    'You have successfully log in!',
                                    'success'
                                );

                            }, 3000);

                           window.location.href='/';
                            
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Login failed!',
                                text: 'Please check credentials!',
                                footer: '<a href="">Why do I have this issue?</a>'
                            })
                        }

                        $('#register_btn').text(' Log in');  
                        $('#register_btn').prop('disabled', false);
                        
                    }           
                });
 
            }
        });
        $.validator.addMethod("pwcheck", function(value) {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                && /[a-z]/.test(value) // has a lowercase letter
                && /\d/.test(value) // has a digit
        });
});
</script>

</body>
</html>