


<div class="col-md-12 clear"> 
    <div id="list-type" class="proerty-th">

        <input type="hidden" value="" id="current_page">

    @foreach($properties as $list)

            <div class="col-sm-6 col-md-4 p0">
                <div class="box-two proerty-item">
                    <div class="item-thumb" style="height: 250px; overflow: hidden;">
                        <a href="<?php echo '/seeker/properties/'.$list['property_id']; ?>" ><img src="<?php echo asset('property_img/'.$list['prop_img']);?>"></a>
                    </div>

                    <div class="item-entry overflow">
                        <h5><a href="<?php echo '/seeker/properties/'.$list['property_id']; ?>"> <?php echo ucwords($list['title']); ?> </a></h5>
                        <div class="dot-hr"></div>
                        <span class="pull-left"><b> Area :</b> <?php echo number_format($list['property_size']); ?>m </span>
                        <span class="proerty-price pull-right"> ₱ <?php echo number_format($list['amount'], 2); ?></span>
                        <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                        <!-- <div class="property-icon">
                            <img src="{{ asset('seekers_assets/assets/img/icon/bed.png'); }}">(5)|
                            <img src="{{ asset('seekers_assets/assets/img/icon/shawer.png'); }}">(2)|
                            <img src="{{ asset('seekers_assets/assets/img/icon/cars.png'); }}">(1)  
                        </div> -->
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>

<div class="col-md-12"> 
    <div class="pull-right">
        <div class="pagination">
            <ul>
              
            <?php
                //   $page_num = 9; 
                  //$count = 800;

                  $num_pages = $count / $page_num;

                  $num_page_result = ceil($num_pages);
                 
                  if($num_page_result > 1){

                        echo '<li><a href="javascript:void(0)">Prev</a></li>';

                        $spread = '';

                        if($num_page_result > 10){

                            $page_count = 10;
                            $spread = '<li><a href="javascript:void(0)"> ... </a></li>';

                        }else{

                            $page_count = $num_page_result;
                            
                        }

                        for($x = 0; $x < $page_count; $x++){

                            echo '<li><a href="javascript:void(0)" onclick="setOffset('.$page_num * $x.')">'.($x+1).'</a></li>';

                        }

                        echo $spread;

                        echo '<li><a href="javascript:void(0)">Next</a></li>';

                  }

            ?>
                <!-- 
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                 -->
            </ul>
        </div>
    </div>                
</div>

<script>
    function setOffset(offset){

        document.getElementById('offset_start').value = offset;
        get_data();


    }
</script>


