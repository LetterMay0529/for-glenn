@include('admin.content.header')
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
			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">


					<div class="row">
						<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
							<h1 class="page-title txt-color-blueDark">
								
								<!-- PAGE HEADER -->
								<i class="fa-fw fa fa-pencil-home-o"></i> 
									Agent
								<span>>  
									Subscription Plan
								</span>
							</h1>
						</div>
						
					</div>

					

					<!-- widget grid -->
					<section id="widget-grid" class="">
						<!-- START ROW -->

						<div class="row">

							<!-- NEW COL START -->
							<article class="col-sm-12 col-md-12 col-lg-12">
                            <div class="well well-light">
							
							<center>
								<div><h1>REAL ESTATE PORTAL <br><small>Agent Subscription Plan</small></h1>
							</center>
							<br>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-4"></div>
									<div class="col-xs-12 col-sm-6 col-md-4" id="subs_box">

									@if($result->isEmpty())
										<div class="panel panel-darken pricing-big">
											
											<div class="panel-heading">
												<h3 class="panel-title">
													Premium Plan Subscription</h3>
											</div>
											<div class="panel-body no-padding text-align-center">
												<div class="the-price">
													<h1>
														$12.99<span class="subscript">/ month</span></h1>
												</div>
												<div class="price-features">
													<p>
														Subscribe now to our plan to post unlimited property listing!!
													</p><br>
													@if($prev->isEmpty()) 
														
													@else
													<table class="table table-bordered">
														<thead>
															<tr>
																<th>Column name</th>
																<th>Column name</th> 
															</tr>
														</thead>
														<tbody>
													<?php 
													
													foreach($prev as $data){
														echo "<tr>";
														echo "<td>".date('D, M j, Y', strtotime($data['date_started']))."</td>";
														echo "<td>".$data['status']."</td>";
														echo "</tr>";
													} 
													?>
													</table>
													@endif
													<h2 style="font-style:italic;">" Pay $0.00 for the first month "</h2>
												</div>
											</div>
											<div class="panel-footer text-align-center">
												<!-- <div id="paypal-button-container-P-8AF95227J6634911SMFVZTWQ"></div>
												<div id="paypal-button-container-P-54H43225158004842MFV2VUI"></div>
													<script src="https://www.paypal.com/sdk/js?client-id=Aak0veXt86Amn14wmDnXIebaRJarPkjjYxdOVa3eBQ0G3ACTLXzhQMJosmzAfKlKfiPBsBi9wvL20JXC&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
													<script>
													paypal.Buttons({
														style: {
															shape: 'rect',
															color: 'gold',
															layout: 'vertical',
															label: 'subscribe'
														},
														createSubscription: function(data, actions) {
															return actions.subscription.create({
															/* Creates the subscription */
															plan_id: 'P-54H43225158004842MFV2VUI'
															});
														},
														onApprove: function(data, actions) {
															//alert(data.subscriptionID); 
															console.log(data);// You can add optional success message for the subscriber here

															save_data_subscription(data.subscriptionID , data.orderID);
															
														}
													}).render('#paypal-button-container-P-54H43225158004842MFV2VUI'); // Renders the PayPal button
													</script> -->

													<div id="paypal-button-container-P-0L8283222G439141VMF5YZ2A"></div>
													<script src="https://www.paypal.com/sdk/js?client-id=Aak0veXt86Amn14wmDnXIebaRJarPkjjYxdOVa3eBQ0G3ACTLXzhQMJosmzAfKlKfiPBsBi9wvL20JXC&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
													<script>
													paypal.Buttons({
														style: {
															shape: 'rect',
															color: 'gold',
															layout: 'vertical',
															label: 'subscribe'
														},
														createSubscription: function(data, actions) {
															return actions.subscription.create({
															/* Creates the subscription */
															plan_id: 'P-0L8283222G439141VMF5YZ2A'
															});
														},
														onApprove: function(data, actions) {
															save_data_subscription(data.subscriptionID , data.orderID); // You can add optional success message for the subscriber here
														}
													}).render('#paypal-button-container-P-0L8283222G439141VMF5YZ2A'); // Renders the PayPal button
													</script>
											</div>
										</div>

									@else
									<div class="well well-sm well-light">
										<p style="text-align:center; font-style: italic;">"You are currently subscribe to Agent Portal Subscription. You and post unlimited properties in your account with no hesitation.</p>
										<br>
										<p style="text-align:center">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'</p>
										<br><div align=center> 
											<?php 
											$stat = ''; 

											if($result[0]->status == 'active'){
												$stat = 'success';
											}else if($result[0]->status == 'paused'){
												$stat = 'warning';
											}else{
												$stat = 'danger';
											}
											
											?>
											<span>Subscription Status<span> :
											<label class="label label-<?php echo $stat?>"><?php echo ucwords($result[0]->status); ?></label><br><br>
										
											<?php if($result[0]->status=='cancelled'){ ?>
											<div>
											<div class="alert alert-warning fade in">
												<button class="close" data-dismiss="alert">
													×
												</button>
												<i class="fa-fw fa fa-info"></i>
												<strong>Info!</strong> The Real Estate Portal subscription was cancelled.
											</div>  
											
											</div>
											<?php }else{ ?>
											@if($result[0]->status != 'cancelled')
											<input type="button" class="btn btn-danger btn-sm" value="Cancel Subscription" id="cancel_btn">
											@endif

											@if($result[0]->status != 'paused')
											<input type="button" class="btn btn-warning btn-sm" value="Pause Subscription" id="pause_btn">
											@endif

											@if($result[0]->status != 'active')
											<input type="button" class="btn btn-success btn-sm" value="Activate Subscription" id="activate_btn">
											@endif
											<?php } ?>
										</div>
										<br>
									<div>
									@endif
										
									</div>
								<div class="col-xs-12 col-sm-6 col-md-4"></div>		    	
				    		</div>
                                
                                    
                                </div>						
							</article>
							<!-- END COL -->		

						</div>

						<!-- END ROW -->

					</section>
					<!-- end widget grid -->
					</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->
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
		<!-- JQUERY VALIDATE -->
<script src="{{ asset('admin_assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>
<script>

	$(document).ready(function(){

		var url=  "https://api-m.sandbox.paypal.com/v1/billing/plans?plan_id=P-54H43225158004842MFV2VUI&page_size=2&page=1&total_required=true";
		// Bearer accessToken: A21AAJtiPcuphu8w51JYeeSg9sSXJxVYNdIPyY7MfMC2JaNLbQ9jUIW4GNnUKymneTgbHZ2kfw6q7RVoBd0X83NXJxiUlzDsw

		//var url = 'https://api-m.sandbox.paypal.com/v1/billing/subscriptions/I-6FX938TUYDYS/transactions';
		

 //for getting the subscription plan details
		$.ajax({
				"url" : url,
				headers: {
					"Authorization": "Basic " + btoa("AQTruPCAaQWAaYWuJhPxI-5RHMCIpi3fc6tkSGSdrDSpo6onO1nXtknnMjzG7D9-hUAY7xxAPQHW6kEd:ENhGW1xkFZlrui_keMVEn6Sn8zFJmIbdIgWAEMU6Clffe-r9VhnmlO7GlpqW26-FyU3UfVjiM9M4r_R-" )
				},
				"method" : "GET",
				"Content-Type": "application/json",
				"success": function(data){

					console.log(data);
						
					}	
			}); 

//or getting each transaction

			// $.ajax({
			// 	"url" : "https://api-m.sandbox.paypal.com/v1/billing/subscriptions/I-BW452GLLEP1G/transactions",
			// 	"headers": {
			// 		"Authorization": "Bearer A21AAJtiPcuphu8w51JYeeSg9sSXJxVYNdIPyY7MfMC2JaNLbQ9jUIW4GNnUKymneTgbHZ2kfw6q7RVoBd0X83NXJxiUlzDsw"
			// 	},
			// 	"method" : "GET",
			// 	"Content-Type": "application/json",
			// 	"success": function(data){

			// 		console.log(data);

			// 		}	
			// }); 

	})

	function load_subscription_details(){

		$.ajax({
				"url" : "{{ route('agent.load_subscription_data'); }}",
				"headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
				"method" : "POST", 
				"success": function(data){

						$('#subs_box').html(data);
						window.location.reload();

					}	
			}); 

	}

	function save_data_subscription(paypal_sub_id , paypal_order_id){
			$.ajax({
				"url" : "{{ route('agent.add_agent_subscription'); }}",
				"headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				"data" : {"paypal_sub_id":paypal_sub_id, "paypal_order_id": paypal_order_id},
				"method" : "POST", 
				"success": function(data){

						//console.log(data);
						if(data == 'success'){
							$.smallBox({
								title : "You successfully subscribe to REAL ESTATE PORTAL",
								content : "Congratulations!! You may now add or post unlimited properties using your account.",
								color : "#739E73",
								iconSmall : "fa fa-check bounce animated",
								timeout : 4000
							});

							//load_subscription_details();
							window.location.reload();

						}else{
							$.smallBox({
								title : "FAILED!!",
								content : data,
								color : "#C46A69",
								iconSmall : "fa fa-times bounce animated",
								timeout : 4000
							});
						} 

					}	
			}); 
	}
</script>

<script>

</script>

<?php if($result->isEmpty()){ }else{?>
	<script>

		//var accessToken = 'A21AAJtiPcuphu8w51JYeeSg9sSXJxVYNdIPyY7MfMC2JaNLbQ9jUIW4GNnUKymneTgbHZ2kfw6q7RVoBd0X83NXJxiUlzDsw';
		var accessToken = 'A21AAJUhgQ0pYlwJS0jLAAVb499geKHdyZy7E2g7LKcMwJtQD-jv6tCK8UDPkJD_8cXILNVqT4tSRa9Jmd5gPwetqg9PhwWnw';
		
		$('#cancel_btn').on('click',function(e){
			
				$.SmartMessageBox({
					title : "Are you sure to cancel the subscription?",
					content : "By clicking \'YES\', this will be permanently cancelled and can't be activated again. You need to re subscribe on the subscription once you decided to avail it in the future!",
					buttons : '[No][Yes]'
				}, function(ButtonPressed) {
					if (ButtonPressed === "Yes") {
		
						update_supcription_status(<?php echo '\''.$result[0]->paypal_sub_id.'\''; ?>, 'cancel', "Customer-requested cancel");
						$('#cancel_btn').val('Processing...');
					}
				});
				e.preventDefault();

		});
		$('#pause_btn').on('click',function(e){
			
			$.SmartMessageBox({
					title : "Are you sure to pause subscription?",
					content : "By clicking \'YES\', the subscription will be suspended in your account!",
					buttons : '[No][Yes]'
				}, function(ButtonPressed) {
					if (ButtonPressed === "Yes") {
		
						update_supcription_status(<?php echo '\''.$result[0]->paypal_sub_id.'\''; ?>, 'suspend', "Customer-requested pause");
						$('#pause_btn').val('Processing...');
					}
				});
				e.preventDefault();

		});
		$('#activate_btn').on('click',function(e){
			// With Callback
			
				$.SmartMessageBox({
					title : "Activate REAL ESTATE PORTAL AGENT SUBSCRIPTION!",
					content : "By clicking \'YES\', you are authorizing us to charge you every month for the subscription!",
					buttons : '[No][Yes]'
				}, function(ButtonPressed) {
					if (ButtonPressed === "Yes") {
		
						update_supcription_status(<?php echo '\''.$result[0]->paypal_sub_id.'\''; ?>, 'activate', "Customer-requested to activate");
						$('#activate_btn').val('Processing...');
					}
				});
				e.preventDefault();
			
		});


		function update_supcription_status(paypal_sub_id, status, reason){

			$.ajax({
				"url" : "{{ route('agent.update_agent_subscription_status'); }}", 
				"headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				"method" : "POST", 
				"data": {
					"paypal_sub_id": paypal_sub_id,
					"command": status, //type: activate, cancel, paused
					"reason": reason,
					"subscription_id": "<?php echo $result[0]->subscription_id; ?>"
				},
				"success": function(data){

						console.log(data);
						window.location.reload();

					}	
			});
		}
 
	</script>


<?php } ?>
@include('admin.content.footer')

