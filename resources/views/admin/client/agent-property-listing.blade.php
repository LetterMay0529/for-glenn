@include('admin.content.header')
<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->


<!-- <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' /> -->
<!-- <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js"></script> -->
<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js"></script>
<link
href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css"
rel="stylesheet"
/>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
type="text/css"
/>
<style>

.con { overflow:hidden; margin: 0; padding: 0;}
#map { overflow: visible; top: 0; bottom: 0; width: 100%; height: 200px; }
.spinner {   
    -webkit-animation:spin 1s linear infinite;
    -moz-animation:spin 1s linear infinite;
    animation:spin 1s linear infinite;
}
@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }

/* #map { position:absolute; top:0; bottom:0; width:100%; } */
</style>


@include('admin.content.sidebar')

<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment"> 
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span> 
				</span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li>Agent</li><li>Dashboard</li>
				</ol>
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right">
				<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
				<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
				<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
				</span> -->

			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">


					<div class="row">
						<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
							<h1 class="page-title txt-color-blueDark">
								
								<!-- PAGE HEADER -->
								<i class="fa-fw fa fa-pencil-home-o"></i> 
									Agent
								<span>>  
									List of Properties
								</span>
							</h1>
						</div>

						<?php

						$account = false;
						$prop_count = false;
						$add_prop_btn = false;

						if(auth()->user()->status != 'active'){

							$account = true;
							$add_prop_btn = true;

						}else{
							
							if($count > 3){

								$prop_count = true;
								$add_prop_btn = true;
								
								if($status_active > 0){

									$account = false;
									$prop_count = false;
									$add_prop_btn = false;
									
								}
							}

						}

						?>

						
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
							<input type="button" class="btn btn-primary btn-md" <?php  if($add_prop_btn ){ echo "disabled=\"disabled\""; } ?> value="Add properties" align="right"  data-toggle="modal" data-target="#myModal"> 
						</div>
						
					</div>
					<?php 

						if($account){

							echo '<div class="alert alert-danger fade in">
									<button class="close" data-dismiss="alert">
										×
									</button>
									<i class="fa-fw fa fa-times"></i>
									<strong>Error!</strong> Your account is not activated.
								</div>';

						}
							
						if($prop_count){
								echo '<div class="alert alert-danger fade in">
									<button class="close" data-dismiss="alert">
										×
									</button>
									<i class="fa-fw fa fa-times"></i>
									<strong>Error!</strong> You can\'t add more than 3 properties every months since there is no active membership in your account.
								</div>';
						}

						

						?>

					@if(session()->has('success'))
						<div class="alert alert-block alert-success">
							<a class="close" data-dismiss="alert" href="#">×</a>
							<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> {{ session()->get('title') }}</h4>
							<p>
								{{ session()->get('success') }}
							</p>
						</div>
					@endif
					
					@if(session()->has('error'))
						<div class="alert alert-danger">
							{{ session()->get('error') }}
						</div>
					@endif
					
					@if(auth()->user()->status == 'inactive')
						<div class="alert alert-danger">
							</p>Your account was currently "Disabled". You can no longer post properties using this account. </p>
						</div>
					@endif
					<!-- widget grid -->
					<section id="widget-grid" class="">
						<!-- START ROW -->

						<div class="row">

							<!-- NEW COL START -->
							<article class="col-sm-12 col-md-12 col-lg-12">
															<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
								<!-- widget options:
								usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
				
								data-widget-colorbutton="false"
								data-widget-editbutton="false"
								data-widget-togglebutton="false"
								data-widget-deletebutton="false"
								data-widget-fullscreenbutton="false"
								data-widget-custombutton="false"
								data-widget-collapsed="true"
								data-widget-sortable="false"
				
								-->
								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
									<h2>Properties Posted </h2>
				
								</header>
				
								<!-- widget div-->
								<div>
				
									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->
				
									</div>
									<!-- end widget edit box -->
				
									<!-- widget content -->
									<div class="widget-body no-padding">
				
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
											<thead>			                
												<tr>
													<th data-hide="phone" style="width:10%;">Property ID</th>
													<th data-class="expand" style="width:10%;"><i class="fa fa-fw fa-building text-muted hidden-md hidden-sm hidden-xs"></i> Title</th>
													<th data-hide="phone,tablet,web" style="width:30%;"><i class="fa fa-fw fa-pencil text-muted hidden-md hidden-sm hidden-xs"></i> Description</th>
													<th data-hide="phone,tablet" style="width:5%">Size</th>
													<th style="width:5%;">Price</th>
													<th data-hide="phone,tablet"  style="width:30%;"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> Location</th>
													<th data-hide="">Status</th>
													<th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date Posted</th>
													<th data-hide=""><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Action</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>

									</div>
									<!-- end widget content -->
				
								</div>
								<!-- end widget div -->
				
							</div>
							<!-- end widget -->
							</article>
							<!-- END COL -->		

						</div>

						<!-- END ROW -->

					</section>
					<!-- end widget grid -->

							<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel"><i class="fa fa-building"> </i> Add new properties</h4>
									</div>
									<form class="" action="{{ route('agent.add_properties') }}" id="add_property" enctype="multipart/form-data" method="POST">
										@csrf
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control remove-value" placeholder="Title" name="title" required />
												</div>
												<div class="form-group">
													<textarea class="form-control remove-value" id='description' placeholder="Content" name="description" rows="5" required></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group smart-form">
													<label class="select">
														<select name="property_type" required>
															<option value="0" selected="" disabled="">Property Type</option>
															<option value="commercial">Commercial</option>
															<option value="land">Land</option>
															<option value="residence">Residence</option>
														</select> <i></i> </label>
												</div>
											</div>
										</div>
										</br>
										<div class="row">
										<div class="col-md-6">
												<div class="form-group">
													<label for="tags"> Amount</label>
													<input type="text" class="form-control remove-value" id="tags" name="amount" placeholder="Amount" />
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="tags"> Size</label>
													<input type="text" class="form-control remove-value" id="tags" name="size" placeholder="Property size" />
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-12">
											<label for="category"> Location</label>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
													
															<input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" readonly />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" readonly />
														</div>
													</div>
												</div>
								
												<div class="form-group">
													<div class="con"><div id="map"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group smart-form">
															<label class="label">Property image thumbnail</label>
															<div class="input input-file">
																<span class="button"><input type="file" id="file" class="remove-value" name="property_img" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" name="prop_img"  readonly="">
															</div>
												</div>
											</div>
										</div>
										
										
									
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">
											Cancel
										</button>
										<!-- <button type="submit" class="btn btn-primary">
											Add property
										</button> -->
										
										<input type="submit" class="btn btn-primary"  id="prop_submit_btn" value="Add property ">
									</div>
									</form>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
			
								<!-- Modal -->
						<div class="modal fade" id="show_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;
									</button>
									<h4 class="modal-title" >Property Details</h4>
								</div>
								<form action="{{ route('agent.update_property_details') }}" id="update_property" enctype="multipart/form-data" method="POST">
								@csrf		
								<div class="modal-body"  id="property_details_body">
						
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">
										Cancel
									</button>
									<input type="submit" class="btn btn-primary" id="submit_update_btn" value="Update Property Details">
								</div>
								</form>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->

						<!-- Modal -->
						<div class="modal fade" id="add_photo_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Photos</h4>
									</div>
									<div class="modal-body" id="add_photo_modal_body">
						
						
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">
											Close
										</button>
										<!-- <button type="button" class="btn btn-primary">
											Post Article
										</button> -->
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div>
						<!-- /.modal -->
					</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->
		
        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script>
			if (!window.jQuery) {
				document.write('<script src="{{ asset('admin_assets/js/libs/jquery-2.1.1.min.js'); }} "><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="{{ asset('admin_assets/js/libs/jquery-ui-1.10.3.min.js'); }} "><\/script>');
			}
		</script>
		<!-- CUSTOM NOTIFICATION -->
		<script src="{{ asset('admin_assets/js/notification/SmartNotification.min.js'); }}"></script>

		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="{{ asset('admin_assets/js/plugin/datatables/jquery.dataTables.min.js'); }}"></script>
		<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.colVis.min.js'); }}"></script>
		<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.tableTools.min.js'); }}"></script>
		<script src="{{ asset('admin_assets/js/plugin/datatables/dataTables.bootstrap.min.js'); }}"></script>
		<script src="{{ asset('admin_assets/js/plugin/datatable-responsive/datatables.responsive.min.js'); }}"></script>
		<script>
			$(document).ready(function(){

				var latitude = document.getElementById('latitude');
				var longitude = document.getElementById('longitude');
				mapboxgl.accessToken = 'pk.eyJ1Ijoia2F5b2cxMjMiLCJhIjoiY2t1OGVnbTJ4MHFmdDJ4cDdzaWgzMjg2aCJ9.6YfOKmagqq-4J2zl2dnmGg';
				// get the form inputs we want to update
				const map = new mapboxgl.Map({
						container: 'map', // Container ID
						style: 'mapbox://styles/mapbox/streets-v11', // Map style to use
						center: [-122.25948, 37.87221], // Starting position [lng, lat]
						zoom: 12, // Starting zoom level
						attributionControl: false
						});
						
						
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
						
						// Add the geocoder to the map
						map.addControl(geocoder);
						
						// After the map style has loaded on the page,
						// add a source layer and default styling for a single point
						map.on('load', () => {
							map.addSource('single-point', {
								'type': 'geojson',
								'data': {
								'type': 'FeatureCollection',
								'features': []
								}
							});
							
							map.addLayer({
							'id': 'point',
							'source': 'single-point',
							'type': 'circle',
							'paint': {
							'circle-radius': 10,
							'circle-color': '#448ee4'
							}
						});
						
						// Listen for the `result` event from the Geocoder // `result` event is triggered when a user makes a selection
						//  Add a marker at the result's coordinates
						geocoder.on('result', ({ result }) => {
							map.getSource('single-point').setData(result.geometry);
							});
						});

					$.getJSON("https://ipgeolocation.abstractapi.com/v1/?api_key=dbfe0e2741a54253828efe106d4f8b73", function(data) {
						longitude.value = data.longitude;
						latitude.value = data.latitude;
						coordinates = [parseFloat(data.longitude), parseFloat(data.latitude)]
					}).done(function(){
						map.flyTo({ center:coordinates, essential: true });
					});
					var marker = new mapboxgl.Marker();

					map.on('click', function(ev) {
						// ev.latlng gives us the coordinates of
						// the spot clicked on the map.
						var coordinates = ev.lngLat;
						longitude.value = coordinates.lng;
						latitude.value = coordinates.lat;
						marker.setLngLat(coordinates).addTo(map);
						//map.flyTo({ center:coordinates, essential: true });
					});

				//modal button when clicked
				$('#myModal').on('shown.bs.modal', function () { // chooseLocation is the id of the modal.
					map.resize();
					//map.invalidateSize();

				});

				var $add_property = $("#add_property").validate({
	
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
						},
						prop_img : {
							required : true
						}
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
						},
						prop_img : {
							required : '<p style="color:red">Please enter property image</p>'
						}
					},
					// Ajax form submition
						submitHandler : function(form) {
							$(form).ajaxSubmit({
								beforeSend: function() { 
									document.getElementById('prop_submit_btn').value = 'Submitting ...';  
									$('#prop_submit_btn').prop('disabled', true);
								},
								success : function(res) {

									document.getElementById('prop_submit_btn').value = 'Add property';  
									$('#prop_submit_btn').prop('disabled', false);

									if(res == 'SUCCESS'){
										$.smallBox({
											title : "Property successfully posted",
											content : "<i class='fa fa-building-o'></i> <i>2 seconds ago...</i>",
											color : "#739E73",
											iconSmall : "fa fa-check bounce animated",
											timeout : 4000
										});
										$('input[name=title]').val('');
										$('textarea#description').val('');
										$('input[name=amount]').val('');
										$('input[name=size]').val('');
										$('input[name=prop_img]').val('');
										//$('#add_property')[0].reset();
										// form.find('textarea,input,select').not('input[name="latitude"],input[name="longitude"]').val('');
										$('#myModal').modal('hide');

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
	
		<script>

			/* BASIC ;*/
				var responsiveHelper_dt_basic = undefined;
				var responsiveHelper_datatable_fixed_column = undefined;
				var responsiveHelper_datatable_col_reorder = undefined;
				var responsiveHelper_datatable_tabletools = undefined;
				
				var breakpointDefinition = {
					tablet : 1024,
					phone : 480
				};
	
				var oTable = $('#dt_basic').dataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "{{ route('agent.show_prop_posted'); }}",
					"columns": [

							{data: 'property_id', name: 'property_id'},

							{data: 'title', name: 'title'},

							{data: 'description', name: 'description'},

							{data: 'property_size', name: 'property_size'},

							{data: 'amount', name: 'amount'},

							{data: 'location', name: 'location'},

							{data: 'property_status', name: 'property_status'},

							{data: 'created_at', name: 'created_at'},

							{data: 'action', name: 'action', orderable: false, searchable: false},

						],
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
						"t"+"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});

	function show_details(id){
		$('#show_details').modal('show');
		$.ajax({
			"url" : "{{ route('agent.show_prop_by_id'); }}",
			"headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			"method" : "POST",
			"data": {id : id},
			"beforeSend": function(){
				$('#property_details_body').html('<div align="center"><img style="width: 45px;"  src="{{ asset("admin_assets/img/loading/spinner.svg"); }}"></div>');
			},
			"success": function(data){
				//alert(data);
				//$('#property_details_body').html();
				$('#property_details_body').html(data);
			}

		})
	}


	function remove_properties(prop_id, title){
				$.SmartMessageBox({
					title : "Remove Properties",
					content : "Are you sure that you want to remove this \""+title+"\" ?",
					buttons : '[Cancel][Yes]'
				}, function(ButtonPressed) {
					if (ButtonPressed === "Yes") {
						
						$.ajax({
							"url" : "{{ route('agent.remove_properties'); }}",
							"headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							"method" : "POST",
							"data": {prop_id : prop_id},
							"beforeSend": function(){
								//$('#property_details_body').html('<div align="center"><img style="width: 45px;"  src="{{ asset("admin_assets/img/loading/spinner.svg"); }}"></div>');
							},
							"success": function(data){
								$.smallBox({
									title : "Properties Removed",
									content : "<i class='fa fa-trash'></i> <i>Successfully removed...</i>",
									color : "#659265",
									iconSmall : "fa fa-check fa-2x fadeInRight animated",
									timeout : 4000
								});

								$('#td_'+prop_id).fadeOut('slow');
								oTable.api().ajax.reload();
							}

						})

					}
					if (ButtonPressed === "Cancel") {
						// $.smallBox({
						// 	title : "Callback function",
						// 	content : "<i class='fa fa-clock-o'></i> <i>You pressed No...</i>",
						// 	color : "#C46A69",
						// 	iconSmall : "fa fa-times fa-2x fadeInRight animated",
						// 	timeout : 4000
						// });
					}
		
				});
				//e.preventDefault();
	}
	

function add_more_photos(prop_id){
	$('#add_photo_modal').modal('show');
	$('#add_photo_modal_body').html('<div align="center"><img style="width: 45px;"  src="{{ asset("admin_assets/img/loading/spinner.svg"); }}"></div>');
	$.ajax({
		"url" : "{{ route('agent.add_images'); }}",
		"headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		"method" : "POST",
		"data": {"prop_id": prop_id}, 
		"success": function(data){
			$('#add_photo_modal_body').html(data);
		}

	});
}
</script>
@include('admin.content.footer')

