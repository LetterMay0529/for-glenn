@include('seekers.layouts.header')

<!-- property area -->
<div class="content-area single-property" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   

                <div class="clearfix padding-top-40" >

                    <div class="col-md-8 single-property-content prp-style-1 ">
                        <div class="row">
                            <div class="light-slide-item">            
                                <div class="clearfix"> 

                                    <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                    <li data-thumb="<?php echo asset('property_img/'.$result[0]->prop_img); ?>"> 
                                            <img src="<?php echo asset('property_img/'.$result[0]->prop_img); ?>" />
                                        </li>
                                        @foreach($photos as $img)
                                        <li data-thumb="<?php echo asset('property_img/'.$img->image_name); ?>"> 
                                            <img src="<?php echo asset('property_img/'.$img->image_name); ?>" />
                                        </li>
                                        @endforeach                                      
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="single-property-wrapper">
                            <div class="single-property-header">  
                                <?php
                                
                                if($result[0]->property_type == 'land'){
                                    $acr = "PTL-";
                                }else if($result[0]->property_type == 'commercial'){
                                    $acr = "PTC-";
                                }else{
                                    $acr = "PTR-";
                                }

                                ?>                                        
                                <h1 class="property-title pull-left"><?php echo "<strong>".$acr.$result[0]->property_id."</strong>: ".$result[0]->title; ?></h1>
                                <span class="property-price pull-right"><?php echo '₱ '.number_format($result[0]->amount,2); ?></span>
                            </div>
                            <div class="property-meta entry-meta clearfix ">
                            <?php if(!empty(auth()->user())){ ?>
                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <button class="btn btn-primary" onclick="add_to_favorite(<?php echo $prop_id; ?>)">Add to Favorite</button>
                                </div>
                            <?php } ?>
                            </div>

                             

                            <div class="section">
                                <h4 class="s-property-title">Description</h4>
                                <div class="s-property-content">
                                    <p><?php echo $result[0]->description; ?></p>
                                </div>
                            </div>
                            <div class="section">
                                <h4 class="s-property-title">Availability</h4>
                                <div class="s-property-content">
                                    <p><?php  
                                    if($result[0]->property_status == 'availables'){
                                        echo "<label class='label label-success'>Available</label>";
                                    }elseif($result[0]->property_status == 'sold'){
                                        echo "<label class='label label-danger'>Sold</label>";
                                    }else{
                                        echo "<label class='label label-danger'>Removed</label>";
                                    }
                                    ?></p>
                                </div>
                            </div>

                            <div class="section">
                                <h4 class="s-property-title">Location</h4>
                                <div id="map"></div>
                            </div>
                            
 
                              
                            
                        </div>
 
                    </div>


                    <div class="col-md-4 p0">
                        <aside class="sidebar sidebar-property blog-asside-right">
                            <div class="dealer-widget">
                                <div class="dealer-content">
                                    <div class="inner-wrapper">

                                        <div class="clear">
                                            <div class="col-xs-4 col-sm-4 dealer-face">
                                                <a href="">
                                                    <?php
                                                    
                                                    if($result[0]->profile_img == 'none'){

                                                        $profile = 'avatar-agent.jpg';

                                                    }else{

                                                        $profile = $result[0]->profile_img;

                                                    }
                                                    
                                                    ?>


                                                    <img src="<?php echo asset('profile_img/'.$profile); ?>" class="img-circle" style="height: 90px; object-fit:cover;">
                                                </a>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 ">
                                                <h3 class="dealer-name">
                                                    <a href=""><?php echo ucwords($result[0]->firstname.' '.$result[0]->lastname); ?></a>
                                                    <span>Real Estate Agent</span>        
                                                </h3>
            

                                            </div>
                                        </div>

                                        <div class="clear">
                                            <ul class="dealer-contacts">                                       
                                                <li><i class="pe-7s-user strong"> </i> <?php echo  $result[0]->username; ?></li>
                                                <li><i class="pe-7s-mail strong" > </i><a style="color:white;" href="mailto:<?php echo  $result[0]->email; ?>"> <?php echo  $result[0]->email; ?></a></li>
                                                <li><i class="pe-7s-call strong"> </i> + <?php echo  $result[0]->phone; ?></li>
                                            </ul>
                                            <p><?php echo  nl2br(e($result[0]->about_me)); ?></p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default sidebar-menu similar-property-wdg wow fadeInRight animated">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Similar Properties</h3>
                                </div>
                                <div class="panel-body recent-property-widget">
                                        <ul> 
                                            @foreach($recommended as $list)
                                                    <li >
                                                        <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0" style="overflow:hidden:height: 50px; clear: both;"  >
                                                            <a href="single.html" ><img style="width: 100%;"src="<?php echo asset('property_img/'.$list['prop_img']);?>"></a> 
                                                        </div>
                                                        <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                                            <h6> <a href="<?php echo '/seeker/properties/'.$list['property_id']; ?>"><?php echo ucwords($list['title']);?></a></h6>
                                                            <span class="property-price">₱ <?php echo number_format($list['amount'],2);?></span>
                                                        </div>
                                                    </li> 

                                            @endforeach
                                    </ul>
                                </div>
                            </div>      


                        </aside>
                    </div>
                </div> 
            </div>
        </div>

@include('seekers.layouts.footer') 
<script>
            $(document).ready(function () {

                $('#image-gallery').lightSlider({
                    gallery: true,
                    item: 1,
                    thumbItem: 9,
                    slideMargin: 0,
                    speed: 500,
                    auto: true,
                    loop: true,
                    onSliderLoad: function () {
                        $('#image-gallery').removeClass('cS-hidden');
                    }
                });
            });
    
    function add_to_favorite(prop_id){
        const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger' 
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Add to favorite?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, add it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: "<?php echo route('seeker.add_items_favorite'); ?>",
                            method: "POST",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                "prop_id": "<?php echo $prop_id; ?>", 
                            },
                            success: function(res){
                                if(res == "SUCCESS"){
                                    swalWithBootstrapButtons.fire(
                                        'Success!',
                                        'Your property has been added to your favorite.',
                                        'success'
                                    )
                                }else if(res =='LOGIN'){

                                    swalWithBootstrapButtons.fire(
                                        'Failed',
                                        'Please login first!',
                                        'error'
                                    )

                                }else if(res =='ADDED'){

                                swalWithBootstrapButtons.fire(
                                    'Failed',
                                    'Property was already added',
                                    'error'
                                )

                                }else{
                                    swalWithBootstrapButtons.fire(
                                        'Failed',
                                        'Property failed to be added on your favorite. Please try again!',
                                        'error'
                                    )
                                }
                            },
                            error: function(err){
                                    swalWithBootstrapButtons.fire(
                                        'Failed',
                                        'Property failed to be added on your favorite. Please try again!',
                                        'error'
                                    )
                            }   
                        }); 

                    } 
             })
    }
</script>
<script type="text/javascript" src="{{ asset('seekers_assets/assets/js/lightslider.min.js'); }}"></script>
<script>
     $(document).ready(function(){
        mapboxgl.accessToken = 'pk.eyJ1Ijoia2F5b2cxMjMiLCJhIjoiY2t1OGVnbTJ4MHFmdDJ4cDdzaWgzMjg2aCJ9.6YfOKmagqq-4J2zl2dnmGg';
 
        <?php 
        
        $location = explode(',',$result[0]->location);

        $lat = $location[1];
        $long = $location[0];
        
        ?>
  
				// get the form inputs we want to update
				const map = new mapboxgl.Map({
						container: 'map', // Container ID
						style: 'mapbox://styles/mapbox/streets-v11', // Map style to use
						center: [<?php echo $lat; ?>, <?php echo $long; ?>], // Starting position [lng, lat]
						zoom: 12, // Starting zoom level
						attributionControl: false
						});

                        // Create a DOM element for each marker.
                        const el = document.createElement('div');
                        const width = 60
                        const height = 60;
                        el.className = 'marker';
                        el.style.backgroundImage = `url(<?php echo asset('seekers_assets/assets/img/icon/locator.png');?>)`;
                        el.style.width = `${width}px`;
                        el.style.height = `${height}px`;
                        el.style.backgroundSize = '100%';
                
                
                        // Add markers to the map.
                        new mapboxgl.Marker(el)
                            .setLngLat([<?php echo $lat; ?>, <?php echo $long; ?>]) 
                            .addTo(map);
                
						
						const geocoder = new MapboxGeocoder({
						// Initialize the geocoder
						accessToken: mapboxgl.accessToken, // Set the access token
						mapboxgl: mapboxgl, // Set the mapbox-gl instance
						marker: false, // Do not use the default marker style
						placeholder: 'Search for places', // Placeholder text for the search bar
						});

						// Add geolocate control to the map.
						map.addControl(
							new mapboxgl.GeolocateControl({
							positionOptions: {
							enableHighAccuracy: true
							},
							// When active the map will receive updates to the device's location as it changes.
							trackUserLocation: true,
							// Draw an arrow next to the location dot to indicate which direction the device is heading.
							showUserHeading: true
							})
						); 

		map.addControl(geocoder);

       
     })
 </script>
</body>
</html>