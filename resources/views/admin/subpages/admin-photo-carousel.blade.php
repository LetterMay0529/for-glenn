<?php 

$num_count = count($photo_result); 

if($num_count == 0){
    echo "No photo uploaded";
}else{
?>
<div id="myCarousel-2" class="carousel slide">
<ol class="carousel-indicators">
    <?php for($x = 0; $x < $num_count; $x++){ ?>
    <li data-target="#myCarousel-2" data-slide-to="<?php echo $x; ?>" class="active"></li> 
    <?php }?>

</ol>
<div class="carousel-inner">
    <!-- Slide 1 -->
    <?php $x=0; foreach($photo_result as $list){ $x++; ?>
    <div class="item <?php if($x == 1){ echo 'active'; }?>">
        <img src="<?php echo asset('property_img/'.$list->image_name); ?>" alt="">
        <!-- <div class="carousel-caption caption-right">
            <h4>Title 1</h4>
            <p>
                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
            </p>
            <br>
            <a href="javascript:void(0);" class="btn btn-info btn-sm">Read more</a>
        </div> -->
    </div>
    <?php } ?>
</div>

<?php if($num_count > 1){?>
<a class="left carousel-control" href="#myCarousel-2" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
<a class="right carousel-control" href="#myCarousel-2" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
<?php } ?>
</div>

<?php } ?>

<script>
    $(document).ready(function(){

        $('.carousel.slide').carousel({
            interval : 3000,
            cycle : true
        });

        $('.carousel.fade').carousel({
            interval : 3000,
            cycle : true
        });

    })
</script>