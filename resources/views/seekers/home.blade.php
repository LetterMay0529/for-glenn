
@include('seekers.layouts.header') 

<div class="slider-area" style="height:350px;">
    <div class="slider">
        <div id="bg-slider" class="owl-carouse owl-theme">

            <div class="img-fluid"><img src="{{ asset('seekers_assets/assets/img/slide1/1.png'); }}" alt="The Last of us"></div>
            <div class="img-fluid"><img src="{{ asset('seekers_assets/assets/img/slide1/2.png'); }}" alt="GTA V"></div>
            <div class="img-fluid"><img src="{{ asset('seekers_assets/assets/img/slide1/3.png'); }}" alt="GTA V"></div>
            <div class="img-fluid"><img src="{{ asset('seekers_assets/assets/img/slide1/4.png'); }}" alt="GTA V"></div>

        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                <!-- /.feature title -->
                <h2>New Property Posted</h2>
            </div>
        </div>
    </div>
</div>




<!-- property area -->
<div class="content-area recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
    <div class="container">
        

        <div class="row">
            <div class="proerty-th">

                

                <?php foreach($data as $list){?>
                <div class="col-sm-6 col-md-3 p0">
                    <div class="box-two proerty-item">
                        <div class="item-thumb">
                            <a href="<?php echo '/seeker/properties/'.$list['property_id']; ?>" ><img src="<?php echo asset('property_img/'.$list['prop_img']); ?>"></a>
                        </div>
                        <div class="item-entry overflow">
                            <h5 style="overflow: ellipsis;"><a href="property-1.html" ><?php echo $list['title'];?> </a></h5>
                            <div class="dot-hr"></div>
                            <span class="pull-left"><b>Area :</b> <?php echo $list['property_size'];?> </span>
                            <span class="proerty-price pull-right"><?php echo $list['price'];?></span>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="col-sm-6 col-md-3 p0">
                    <div class="box-tree more-proerty text-center">
                        <div class="item-tree-icon">
                            <i class="fa fa-th"></i>
                        </div>
                        <div class="more-entry overflow">
                            <h5><a href="{{ route('seeker.properties'); }}" >CAN'T DECIDE ? </a></h5>
                            <h5 class="tree-sub-ttl">Show all properties</h5>
                            <a href="{{ route('seeker.properties'); }}"><button class="btn border-btn more-black" value="All properties">All properties</button></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!--Welcome area -->
<div class="Welcome-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 Welcome-entry  col-sm-12">
                <div class="col-md-5 col-md-offset-2 col-sm-6 col-xs-12">
                    <div class="welcome_text wow fadeInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 col-sm-10 page-title">
                                <!-- /.feature title -->
                                <h2><img src="{{ asset('seekers_assets/assets/img/slide1/cc.png') }}" alt=""></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div  class="welcome_services wow fadeInRight" data-wow-delay="0.3s" data-wow-offset="100">
                        <div class="row">
                            <div class="col-xs-6 m-padding">
                                <div class="welcome-estate">
                                    <div class="welcome-icon">
                                        <i class="pe-7s-home pe-4x"></i>
                                    </div>
                                    <h3>Any property</h3>
                                </div>
                            </div>
                            <div class="col-xs-6 m-padding">
                                <div class="welcome-estate">
                                    <div class="welcome-icon">
                                        <i class="pe-7s-users pe-4x"></i>
                                    </div>
                                    <h3>More Agents</h3>
                                </div>
                            </div>


                            <div class="col-xs-12 text-center">
                                <i class="welcome-circle"></i>
                            </div>

                            <div class="col-xs-6 m-padding">
                                <div class="welcome-estate">
                                    <div class="welcome-icon">
                                        <i class="pe-7s-notebook pe-4x"></i>
                                    </div>
                                    <h3>Easy to use</h3>
                                </div>
                            </div>
                            <div class="col-xs-6 m-padding">
                                <div class="welcome-estate">
                                    <div class="welcome-icon">
                                        <i class="pe-7s-help2 pe-4x"></i>
                                    </div>
                                    <h3>Any help </h3>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Count area -->
<div class="count-area">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                <!-- /.feature title -->
                <h2>You can trust Us </h2> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12 percent-blocks m-main" data-waypoint-scroll="true">
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <div class="count-item">
                            <div class="count-item-circle">
                                <span class="pe-7s-users"></span>
                            </div>
                            <div class="chart" data-percent="5000">
                                <h2 class="percent">0</h2>
                                <h5>HAPPY CUSTOMER </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="count-item">
                            <div class="count-item-circle">
                                <span class="pe-7s-home"></span>
                            </div>
                            <div class="chart" data-percent="<?php echo $avail_prop; ?>">
                                <h2 class="percent">0</h2>
                                <h5>Properties Availables</h5>
                            </div>
                        </div> 
                    </div> 
                    <div class="col-sm-3 col-xs-6">
                        <div class="count-item">
                            <div class="count-item-circle">
                                <span class="pe-7s-flag"></span>
                            </div>
                            <div class="chart" data-percent="120">
                                <h2 class="percent">0</h2>
                                <h5>City registered </h5>
                            </div>
                        </div> 
                    </div> 
                    <div class="col-sm-3 col-xs-6">
                        <div class="count-item">
                            <div class="count-item-circle">
                                <span class="pe-7s-graph2"></span>
                            </div>
                            <div class="chart" data-percent="5000">
                                <h2 class="percent">0</h2>
                                <h5>DEALER BRANCHES</h5>
                            </div>
                        </div> 

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- boy-sale area -->
<div class="boy-sale-area">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-10 col-sm-offset-1 col-md-offset-0 col-xs-12">
                <div class="asks-first">
                    <div class="asks-first-circle">
                        <span class="fa fa-search"></span>
                    </div>
                    <div class="asks-first-info">
                        <h2>ARE YOU LOOKING FOR A Property?</h2>
                        <p> varius od lio eget conseq uat blandit, lorem auglue comm lodo nisl no us nibh mas lsa</p>                                        
                    </div>
                    <div class="asks-first-arrow">
                        <a href="{{ route('seeker.properties'); }}"><span class="fa fa-angle-right"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-10 col-sm-offset-1 col-xs-12 col-md-offset-0">
                <div  class="asks-first">
                    <div class="asks-first-circle">
                        <span class="fa fa-usd"></span>
                    </div>
                    <div class="asks-first-info">
                        <h2>DO YOU WANT TO SELL A Property?</h2>
                        <p> varius od lio eget conseq uat blandit, lorem auglue comm lodo nisl no us nibh mas lsa</p>
                    </div>
                    <div class="asks-first-arrow">
                        <a href="{{route('create_admin_account')}}"><span class="fa fa-angle-right"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <p  class="asks-call">QUESTIONS? CALL US  : <span class="strong"> +639 102 727 943</span></p>
            </div>
        </div>
    </div>
</div>
@include('seekers.layouts.footer')

<script>
    $(function(){
        
    });
</script>