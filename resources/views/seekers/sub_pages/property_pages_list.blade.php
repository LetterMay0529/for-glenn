<div class="col-md-12 clear"> 
    <div id="list-type" class="proerty-th">
            
    </div>
</div>

<div class="col-md-12"> 
    <div class="pull-right">
        <div class="pagination">
            <ul>
                <li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>
            </ul>
        </div>
    </div>                
</div>

<script>
    $(document).ready(function(){ 

        var loading = '<div class="" style="padding: 50px; text-align:center"><p>Loading ... </p></div>';

        $('#list-type').html(loading);

        $.ajax({
            url: '<?php echo route('seeker.render_property_list'); ?>',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'GET',
            success: function(data){
                $('#list-type').html(data);
            },
            error: function(err){

                console.log(err);
                
            }
        })    
    });
</script>