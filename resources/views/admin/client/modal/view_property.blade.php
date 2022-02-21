
<?php //secho json_encode($data); ?>

<style>
    .con { overflow:hidden; margin: 0; padding: 0;}
    #map-edit { overflow: visible; top: 0; bottom: 0; width: 100%; height: 200px; }

</style>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="hidden" class="form-control remove-value" placeholder="property_id" name="property_id_update" value="{{ $data[0]->property_id; }}" required />
            <input type="text" class="form-control remove-value" placeholder="Title" name="title_update" value="{{ $data[0]->title; }}" required />
        </div>
        <div class="form-group">
            <textarea class="form-control remove-value" id='description' placeholder="Content" name="description_update" rows="5" required>{{ $data[0]->description; }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group smart-form">
        <label for="tags" style="padding-bottom: 5px;"> Property Type</label>
            <label class="select">
                <select name="property_type_update" required>
                    <option value="0" selected="" disabled="">Property Type</option>
                    <option <?= $data[0]->property_type == 'commercial' ? ' selected="selected"' : '';?> value="commercial">Commercial</option>
                    <option <?= $data[0]->property_type == 'land' ? ' selected="selected"' : '';?> value="land">Land</option>
                    <option <?= $data[0]->property_type == 'residence' ? ' selected="selected"' : '';?> value="residence">Residence</option>
                </select> <i></i> </label>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group smart-form">
        <label for="tags" style="padding-bottom: 5px;"> Property Status</label>
            <label class="select">
                <select name="property_status_update" required>
                    <option value="0" selected="" disabled="">Property Status</option>
                    <option <?= $data[0]->property_status == 'availables' ? ' selected="selected"' : '';?> value="availables">Available</option>
                    <option <?= $data[0]->property_status == 'sold' ? ' selected="selected"' : '';?> value="sold"value="land">Sold</option>
                </select> <i></i> </label>
        </div>
    </div>
</div>
</br>
<div class="row">
<div class="col-md-6">
        <div class="form-group">
            <label for="tags"> Amount</label>
            <input type="text"  value="{{ $data[0]->amount; }}" class="form-control remove-value" id="tags" name="amount_update" placeholder="Amount" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tags"> Size</label>
            <input type="text" class="form-control remove-value"  name="size_update" value="{{ $data[0]->property_size; }}" placeholder="Property size" />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <label for="category"> Location</label>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <?php $geolocation = explode(',',$data[0]->location); $lat = $geolocation[0]; $long = $geolocation[1]; ?>
                    <input type="text" class="form-control" id="longitude-update" name="longitude_update" value="{{ $long; }}" placeholder="Longitude" readonly />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="latitude-update" name="latitude_update" value="{{ $lat; }}"  placeholder="Latitude" readonly />
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="con"><div id="map-edit"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group smart-form">
                    <label class="label">Property image thumbnail</label>
                    <div class="input input-file">
                        <span class="button"><input type="file" id="file" class="remove-value" name="property_img_update" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" name="prop_img"  readonly="">
                    </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
   // alert('haha');
    //mapboxgl.accessToken = 'pk.eyJ1Ijoia2F5b2cxMjMiLCJhIjoiY2t1OGVnbTJ4MHFmdDJ4cDdzaWgzMjg2aCJ9.6YfOKmagqq-4J2zl2dnmGg';
    const map2 = new mapboxgl.Map({
            container: 'map-edit',
            style: 'mapbox://styles/mapbox/streets-v11', // Map style to use
            center: [-122.25948, 37.87221], // Starting position [lng, lat]
            zoom: 12, // Starting zoom level
            attributionControl: false
        });

        map2.on('load', () => {
                        map2.addSource('single-point', {
								'type': 'geojson',
								'data': {
								'type': 'FeatureCollection',
								'features': []
								}
							});
							
							map2.addLayer({
                                'id': 'point',
                                'source': 'single-point',
                                'type': 'circle',
                                'paint': {
                                'circle-radius': 10,
                                'circle-color': '#448ee4'
                                }
                            });
        });
		coordinates = [parseFloat(<?php echo $long; ?>), parseFloat(<?php echo $lat; ?>)]
        map2.flyTo({ center:coordinates, essential: true });

        var marker = new mapboxgl.Marker();
        marker.setLngLat(coordinates).addTo(map2);

        map2.on('click', function(ev) {
						// ev.latlng gives us the coordinates of
						// the spot clicked on the map.

                        var latitude = document.getElementById('latitude-update');
				        var longitude = document.getElementById('longitude-update');

						var coordinates = ev.lngLat;
						longitude.value = coordinates.lng;
						latitude.value = coordinates.lat;
						marker.setLngLat(coordinates).addTo(map2);
						//map.flyTo({ center:coordinates, essential: true });
		});
        
		map2.resize();
        var $update_property = $("#update_property").validate({
	
            // Rules for form validation
            rules : {
                title : {
                    required : true
                },
                description : {
                    required : true,
                },
                property_type:{
                    required : true,
                },
                amount : {
                    required : true,
                    number: true
                },
                size : {
                    required : true,
                    number: true
                },
                latitude : {
                    required : true
                },
                longitude : {
                    required : true
                }

                // prop_img : {
                //     required : true
                // }
            },

            // Messages for form validation
            messages : {
                title : {
                    required : '<p style="color:red">Please put title</p>'
                },
                description : {
                    required : '<p style="color:red">Please fill out description</p>'
                },
                property_type: {
                    required : '<p style="color:red">Please choose property type.</p>',
                },
                amount : {
                    required : '<p style="color:red">Please enter amount</p>',
                    number: '<p style="color:red">Please enter a valid number</p>'
                },
                size : {
                    required : '<p style="color:red">Please enter size</p>',
                    number: '<p style="color:red">Please enter a valid number</p>'
                },
                latitude : {
                    required : '<p style="color:red">Please select your latitude</p>'
                },
                longitude : {
                    required : '<p style="color:red">Please enter longitude</p>'
                }
                
                // prop_img : {
                //     required : '<p style="color:red">Please enter property image</p>'
                // }
            },
            // Ajax form submition
                submitHandler : function(form) {
                        $(form).ajaxSubmit({
                            beforeSend: function() { 
                                document.getElementById('submit_update_btn').value = 'Submitting ...';  
                                $('#submit_update_btn').prop('disabled', true);
                            },
                            success : function(res) {

                                document.getElementById('submit_update_btn').value = 'Update Property Details';  
                                $('#submit_update_btn').prop('disabled', false);

                                if(res == 'SUCCESS'){
                                    $.smallBox({
                                        title : "Property successfully posted",
                                        content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
                                        color : "#739E73",
                                        iconSmall : "fa fa-check bounce animated",
                                        timeout : 4000
                                    });
                                    
                                    $('#show_details').modal('hide');

                                    //var oTable = $('#dt_basic').dataTable();
                                    // to reload
                                    oTable.api().ajax.reload();

                                }else{
                                    var json = $.parseJSON(res);
                                    console.log(json.length);
                                    var contents='';

                                    $.each(json, function(index, element) {
                                        //console.log(element);
                                        $.each(element, function(index2, element2) {
                                            contents = contents+'<li>'+element2+'</li>';
                                        });
                                        
                                    });
                                    
                                    $.smallBox({
                                        title : "Posting property error",
                                        content : contents,
                                        color : "#C46A69",
                                        iconSmall : "fa fa-times bounce animated",
                                        timeout : 4000
                                    });
                                }
                                
                            }
                        });
                    },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                }
            });
});
</script>