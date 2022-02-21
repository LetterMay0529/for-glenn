@include('seekers.layouts.header') 

<!-- property area -->
<div class="content-area recent-property" style="background-color: #FFF;">

            <div class="container">   
                <div class="row">

                    <div class="col-md-12 pr-30 padding-top-40 properties-page user-properties"> 

<!-- -----------------START SECTION---------------------- -->
                        <div class="section"> 
                             <div id="map" style="height: 500px;"> </div>
                        </div> 
                    </div>       
 <!-- ----------------END SECTION ---------------------- -->

                </div>
            </div>
        </div>
@include('seekers.layouts.footer')
 <script>
     $(document).ready(function(){
        mapboxgl.accessToken = 'pk.eyJ1Ijoia2F5b2cxMjMiLCJhIjoiY2t1OGVnbTJ4MHFmdDJ4cDdzaWgzMjg2aCJ9.6YfOKmagqq-4J2zl2dnmGg';
 

        const geojson = <?php echo json_encode($geojson); ?>
				// get the form inputs we want to update
				const map = new mapboxgl.Map({
						container: 'map', // Container ID
						style: 'mapbox://styles/mapbox/streets-v11', // Map style to use
						center: [-122.25948, 37.87221], // Starting position [lng, lat]
						zoom: 12, // Starting zoom level
						attributionControl: false
						});

                // Add markers to the map.
                for (const marker of geojson.features) {
                        // Create a DOM element for each marker.
                        const el = document.createElement('div');
                        const width = marker.properties.iconSize[0];
                        const height = marker.properties.iconSize[1];
                        el.className = 'marker';
                        el.style.backgroundImage = `url(<?php echo asset('seekers_assets/assets/img/icon/locator.png');?>)`;
                        el.style.width = `${width}px`;
                        el.style.height = `${height}px`;
                        el.style.backgroundSize = '100%';
                
                    el.addEventListener('click', () => {
                        //window.alert(marker.properties.message+' '+marker.properties.prop_id);
                        window.location.href = '/seeker/properties/'+marker.properties.prop_id;
                    });
                
                    // Add markers to the map.
                    new mapboxgl.Marker(el)
                        .setLngLat(marker.geometry.coordinates) 
                        .addTo(map);
                }
						
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
                        // Create a new marker.map);
                
                        // const marker = new mapboxgl.Marker({
                        //     color: "#FFFFFF",
                        //     draggable: true
                        //     }).setLngLat([30.5, 50.5])
                        //     .addTo(map);
						
						// Add the geocoder to the map

                       // Listen for the `result` event from the Geocoder // `result` event is triggered when a user makes a selection
						//  Add a marker at the result's coordinates
						geocoder.on('result', ({ result }) => {
							map.getSource('single-point').setData(result.geometry);
							}); 

                        $.getJSON("https://ipgeolocation.abstractapi.com/v1/?api_key=dbfe0e2741a54253828efe106d4f8b73", function(data) { 

                            coordinates = [parseFloat(data.longitude), parseFloat(data.latitude)]

                        }).done(function(){

                            map.flyTo({ center:coordinates, essential: true });

                        });

		map.addControl(geocoder);

       
     })
 </script>
</body>
</html>