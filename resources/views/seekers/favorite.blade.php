@include('seekers.layouts.header') 

<style>
    .desc{
        text-overflow: ellipsis;
    }
</style>
<!-- property area -->
<div class="content-area recent-property" style="background-color: #FFF;">

            <div class="container">   
                <div class="row">

                    <div class="col-md-12 pr-30 padding-top-40 properties-page user-properties"> 

<!-- -----------------START SECTION---------------------- -->
                        <div class="section"> 
                            <div id="list-type" class="proerty-th-list">
                                <?php 
                                    if(count($fav) == 0){
                                        echo '<div class="alert alert-warning" role="alert">
                                        No property added yet!
                                      </div>';
                                    }
                                ?>
                                @foreach($fav as $list)
                                <div class="col-md-4 p0" id="box_id_<?php echo $list->fav_id; ?>">
                                    <div class="box-two proerty-item">

                                        <div class="item-thumb">
                                            <a href="/seeker/properties/<?php echo $list->property_id; ?>" ><img src="<?php echo asset('property_img/'.$list->prop_img);?>"></a>
                                        </div>
                                        
                                        <div class="item-entry overflow">
                                            <h5><a href="/seeker/properties/<?php echo $list->property_id; ?>"> <?php echo $list->title; ?> </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Area :</b> <?php echo number_format($list->property_size); ?> SQM </span>
                                            <span class="proerty-price pull-right"> $ <?php echo number_format($list->amount,2); ?></span>
                                            <p style="display: none; white-space: nowrap; overflow:hidden;  " class="desc"><?php echo $list->description; ?></p>
                                            <div class="  pull-right">                      
                                                    <a href="/seeker/properties/<?php echo $list->property_id; ?> " ><button class="btn btn-success">View</button> </a>
                                                    <button class="btn btn-danger" onclick="delete_favorite(<?php echo $list->fav_id; ?>)">Delete</button>
                                            </div>
                                        </div>
 
                                    </div>
                                </div>  
                                @endforeach
                                
                            </div>
                        </div> 
                    </div>       
 <!-- ----------------END SECTION ---------------------- -->

                </div>
            </div>
        </div>
@include('seekers.layouts.footer')
<script>

    function delete_favorite(fav_id){

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'

        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "<?php echo route('seeker.remove_favorite'); ?>",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    data: {
                        "fav_id": fav_id
                    },
                    success: function(res){
                        if(res == 'SUCCESS'){
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                            $('#box_id_'+fav_id).fadeOut('slow');

                        }else{
                            Swal.fire(
                                'Failed!',
                                'Failed on removing property to favorite!',
                                'error'
                            )
                        }
                    },
                    error: function(err){
                        Swal.fire(
                                'Failed!',
                                'Failed on removing property to favorite!',
                                'error'
                        )
                    }
                })

                
                
            }

        });
    }
</script>
</body>
</html>