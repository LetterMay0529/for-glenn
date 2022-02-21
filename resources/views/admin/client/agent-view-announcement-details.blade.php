@include('admin.content.header')
@include('admin.content.sidebar')

<style>
	.link:hover {text-decoration:underline;}
</style>

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
									Announcement
								<span>>  
									Details
								</span>
							</h1>
						</div>
						
					</div>

                    <div class="row">
                        <div class="well well-light">
                            <div style="margin: 0px 50px 0px 50px ;">
                                <center>
                                    <h1>Announcement</h1>
                                    <p>Date Created: <?php echo date('F d, Y h:i A', strtotime($data[0]->created_at)); ?><p>
                                    <br>
                                    <br>
                                    <p style="font-style:italic;"><?php echo $data[0]->content; ?></p>
                                </center>
                            </div>
                        </div>
                    </div>

			</div>
			<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
<@include('admin.content.footer-new.footer-js-new')
@include('admin.content.footer-new.footer-last-new')

