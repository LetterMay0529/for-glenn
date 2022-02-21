@include('seekers.layouts.header') 
<style>
     .item-thumb {
    width: 40%;
    float: left;
}
    .item-thumb img {
        opacity: 0.7;
        height: 230px;
        vertical-align: middle;
        border: 0px none;
        width: 100%;
        padding-right: 25px;
    }
    .item-entry {
        width: 60%;
        float: left;
        padding-right: 15px;
    }
    .overflow {
    overflow: hidden;
    
}


.twolines{
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}
.box-two {
    background: #FFF none repeat scroll 0% 0%;
    border: 1px solid #E6E6E6;
    box-sizing: border-box;
    box-shadow: 0px 1px 5px rgb(0 0 0 / 10%);
}

.description {
    clear: both;
    padding-top: 25px;
    /* padding-right: 20px; */
    display: block !important;
    display: -webkit-box;

}
</style>
<div class="page-head"> 
    <div class="container">
        <div class="row">
            <div class="page-head-content">
                <h1 class="page-title">AGENT Name : <span class="orange strong"><?php echo ucwords($user->firstname.' '.$user->lastname); ?></span></h1>               
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
                                <b>BUILD</b> YOUR PROFILE <br>
                                <small>This information will let us know more about you.</small>
                            </h3>
                            <hr>
                        </div>

                        <div class="clear">
                            <div class="col-sm-3 col-sm-offset-1">
                                <div class="picture-container"> 
                                      <div class="picture">    <!-- class="picture" -->
                                                    <?php 
                                                        
                                                        if($user->profile_img == 'none'){
                                                                $img = asset('profile_img/avatar-agent.jpg');
                                                        }else{
                                                            $img = asset('profile_img/'.$user->profile_img);
                                                        }

                                                    ?> 
                                            <img src="{{ $img }}" class="picture-src" id="profilePreview" title="" style="height: 230px; object-fit: cover;"/>  
                                        </div>
                                </div>  
                            </div>
                            <div class="col-sm-3 padding-top-25">
                                                                    
                                <div class=" ">
                                    <label>First Name <small>(required)</small></label>
                                    <input name="firstname" value="<?php echo $user->firstname; ?>" type="text" class="form-control" readonly placeholder="Firstname...">
                                </div>
                                <div class=" ">
                                    <label>Last Name <small>(required)</small></label>
                                    <input name="lastname" type="text" class="form-control" value="<?php echo $user->lastname; ?>" readonly placeholder="Lastname...">
                                </div> 
                                <div class="form-group">
                                    <label>Email <small>(required)</small></label>
                                    <input name="email" type="email"  value="<?php echo $user->email; ?>" class="form-control" readonly placeholder="andrew@email@email.com.com">
                                </div> 
                            </div>
                            <div class="col-sm-3 padding-top-25">
                                <div class="form-group">
                                    <label>Username <small>(required)</small></label>
                                    <input name="username"  value="<?php echo $user->username; ?>" readonly type="text" class="form-control">
                                </div> 

                            </div>  
                        </div> 
                    </div>                                      
            </div><!-- end row -->

            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 profiel-container">

                        <div class="profiel-header">
                            <h3>
                                <b>Property</b> Posted <br>
                                <small>This are the property recenty posted.</small>
                            </h3>
                            <hr>
                        </div>

                        <div class="clear">
                            <div class="col-sm-12">
                            <table id="dt_basic" class="table table-striped table-bordered table-hover"  >
                                <thead>			                
                                    <tr>
                                        <th style="width: 85%;">Property</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            </div> 
                        </div> 
                </div>                                     
            </div><!-- end row -->
        </div>

    </div>
</div>

@include('seekers.layouts.footer')
<script src="http://127.0.0.1:8000/seekers_assets/assets/js/dataTables.min.js"></script>
<script src="http://127.0.0.1:8000/seekers_assets/assets/js/dataTables.bootstrap.min.js"></script>
<script>
    //$(document).ready(function(){ 
        
        var oTable = $('#dt_basic').dataTable({
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url":"{{ route('seeker.query_agent_posted'); }}",
                                "method": "POST",
                                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                "data": {
                                    "users_id": <?php echo $users_id; ?>
                                },
                            }, 
                            "columns": [

                                    {data: 'users_id', name: 'users_id'}, 

                                ]
                        });
   // });
</script>
</body>
</html>