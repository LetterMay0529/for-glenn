@include('seekers.layouts.header') 

 <!-- register-area -->
 <div class="register-area" style="background-color: rgb(249, 249, 249);">
            <div class="container">

                <div class="col-md-6 col-md-offset-3">
                    <div class="box-for overflow">
                        <div class="col-md-12 col-xs-12 register-blocks">
                            <h2>Create a report</h2> 
                            <p>Please provided describe the issue with complete information.</p>
                            <div class="form-group">
                                    <label for="email">Your Name</label>
                                    <input type="text" class="form-control" id="email" value="<?php echo ucwords(auth()->user()->firstname.' '.auth()->user()->lastname); ?>" readonly>
                            </div>
                            <form action="{{ route('seeker.create_report'); }}" method="post" id="create_form">  
                                <div class="form-group">
                                    <!-- <label for="prop_id" >Property</label>  -->
                                    <select style="width:100%" class="form-control select2" id="property_selected" name="prop_id"></select> 
                                </div>
                                <div class="form-group">
                                    <label for="details" >Report details</label>
                                    <textarea class="form-control" row="8" style="margin-top: 0px; margin-bottom: 0px; height: 164px;" name="details" placeholder="Please include the name of the agent who posted the property."></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
 

            </div>
        </div>   


@include('seekers.layouts.footer')
<script src="{{ asset('seekers_assets/assets/js/select2.min.js'); }}"></script>
<script>

    $(document).ready(function(){

        $('#property_selected').select2({
        ajax:{
            url: "{{ route('agent.query_active_properties'); }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    // _token: token, 
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
         
    }); 

     $("#create_form").validate({
            rules: {
                fullname:{
                    required: true, 
                },
                prop_id:{
                    required: true,
                },
                details:{
                    required: true, 
                }
            },
            messages:{
                fullname:{
                    required: '<p style="color:red">Fullname is required!</p>', 
                },
                prop_id:{
                    required: '<p style="color:red">Property to be reported is required!</p>', 
                }, 
                details:{
                    required: '<p style="color:red">Details is required!</p>', 
                }, 
                
            },
            submitHandler: function(form) {

                $.ajax({
                    url: form.action,
                    type: form.method,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: $(form).serialize(),
                    beforeSend: function() { 
                        $('#submit_btn').text('Submitting in ...');  
                        $('#submit_btn').prop('disabled', true);
                    },
                    success : function(res) {

                        if(res == 'SUCCESS'){
 

                                Swal.fire(
                                    'Good job!',
                                    'A report has been submitted!',
                                    'success'
                                );

                                $('#create_form')[0].reset();
                            
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Creating report failed!',
                                text: 'Please try again!', 
                            })
                        }

                        $('#submit_btn').text('Submit');  
                        $('#submit_btn').prop('disabled', false);
                        
                    }           
                });
 
            }
        }); 


       

</script>
</body>
</html>