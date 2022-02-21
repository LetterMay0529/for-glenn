@include('admin.content.header')
@include('admin.content.sidebar')


<!-- DASHBOARD -->
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
					<li>Admin</li><li>Dashboard</li>
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
									Admin
								<span>>  
									Dashboard
								</span>
							</h1>
						</div>
						
					</div>


        <div class="jumbotron jumbotron-fluid">
            <h1 class="display-5">SC REALESTATE</h1>
                <hr class="my-4">
                <p>SC Real-Estate is a website application aimed at making the process of property transactions easy. These website is designed in a way that makes it easy for buyers, sellers, realtors, and landlords to find each other quickly and conveniently.</p>
        </div>

		</div>

@include('admin.content.footer-new.footer-js-new')
@include('admin.content.footer-new.footer-last-new')
