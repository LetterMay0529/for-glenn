@include('seekers.layouts.header') 
<div class="page-head"> 
    <div class="container">
        <div class="row">
            <div class="page-head-content">
                <h1 class="page-title">Sign in </h1>               
            </div>
        </div>
    </div>
</div>
<!-- End page header -->
 

        <!-- register-area -->
        <div class="register-area" style="background-color: rgb(249, 249, 249);">
            @if(session()->has('warning'))
				<div class="alert alert-warning" style="text-align:center">
					<i class="fa fa-info-circle"></i> {{ session()->get('warning') }}
				</div>
			@endif
            @if(session()->has('error'))
				<div class="alert alert-danger" style="text-align:center">
					<i class="fa fa-info-circle"></i> {{ session()->get('error') }}
				</div>
			@endif<br>
            <div class="container">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="box-for overflow">                         
                        <div class="col-md-12 col-xs-12 login-blocks">
                            <div class="text-center"><h2>Login</h2></div>
                            <form id="login_form" action="{{ route('seeker.login_seeker'); }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-default" style="width:100%;" id="login_btn"> Log in</button>
                                </div>
                            </form> 
                        </div>
                        
                    </div>
                </div>

            </div>
            <div class="container" style="text-align: center;margin-top: 20px;">
                <p>Do you want to sell? <a href="{{route('create_admin_account')}}">Create an account here</a></p>
            </div>
        </div>
        
@include('seekers.layouts.footer')

<script>
    $("#login_form").validate({
            rules: {
                email:{
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    // minlength: 6,
                    // pwcheck: true,
                }
            },
            messages:{
                email:{
                    required: '<p style="color:red">Email is required!</p>',
                    email: '<p style="color:red">Please provide a VALID email address!</p>'
                },
                password:{
                    required: '<p style="color:red">Password is required!</p>', 
                    // minlength: '<p style="color:red">Minimum character is 6</p>',
                    // pwcheck: '<p style="color:red">Password must contain a lower case, digits and a punctuation marks!</p>'
                }
            },
            submitHandler: function(form) {

                $.ajax({
                    url: form.action,
                    type: form.method,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: $(form).serialize(),
                    beforeSend: function() { 
                        document.getElementById('login_btn').value = 'Logging in ...';  
                        $('#login_btn').prop('disabled', true);
                    },
                    success : function(res) {

                        if(res == 'SEEKER_LOGIN'){

                            setTimeout(function(){ 

                                Swal.fire(
                                    'Good job!',
                                    'You have successfully log in!',
                                    'success'
                                );

                            }, 3000);

                           window.location.href='/';
                            
                        }else if(res == 'AGENT_LOGIN'){

                            setTimeout(function(){ 

                                Swal.fire(
                                    'Good job!',
                                    'You have successfully log in!',
                                    'success'
                                );

                            }, 3000);

                            window.location.href='/agent/dashboard';

                            }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Login failed!',
                                text: 'Please check credentials!',
                                footer: '<a href="">Why do I have this issue?</a>'
                            })
                        }

                        document.getElementById('login_btn').value = ' Log in';  
                        $('#login_btn').prop('disabled', false);
                        
                    }           
                });
 
            }
        });
        $.validator.addMethod("pwcheck", function(value) {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                && /[a-z]/.test(value) // has a lowercase letter
                && /\d/.test(value) // has a digit
            });
</script>

</body>
</html>