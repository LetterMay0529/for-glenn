
          <!-- Footer area-->
          <div class="footer-area">

<div class=" footer">
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                <div class="single-footer">
                    <h4>About us </h4>
                    <div class="footer-title-line"></div>
                    <img src="{{ asset('seekers_assets/assets/img/slide1/logosc.png');}}" alt="" class="wow pulse" data-wow-delay="1s" style="max-width: 220px;">
                    <p>SC Real-Estate is a website application aimed at making the process of property transactions easy. These website is designed in a way that makes it easy for buyers, sellers, realtors, and landlords to find each other quickly and conveniently.</p>
                    <ul class="footer-adress">
                        <li><i class="pe-7s-map-marker strong"> </i> 9089 your adress her</li>
                        <li><i class="pe-7s-mail strong"> </i> screalestate21@gmail.com</li>
                        <li><i class="pe-7s-call strong"> </i> +639 102 727 943</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                <div class="single-footer">
                    <h4>Quick links </h4>
                    <div class="footer-title-line"></div>
                    <ul class="footer-menu">
                        <li><a class="wow fadeInUp animated" href="{{ route('home'); }}" data-wow-delay="0.2s">Home</a></li>
                        <li><a class="wow fadeInUp animated" href="{{ route('seeker.properties'); }}" data-wow-delay="0.3s">Properties</a></li>
                        <li><a class="wow fadeInUp animated" href="{{ route('seeker.search_agent'); }}" data-wow-delay="0.4s">Search Agent</a></li>
                        <li><a class="wow fadeInUp animated" href="{{ route('seeker.map'); }}" data-wow-delay="0.6s">Map</a></li>
                        <?php if(!empty(auth()->user()->users_id)){ ?>
                        <li><a class="wow fadeInUp animated{{ (request()->is('seeker/favorite*')) ? 'active' : '' }}" href="{{ route('seeker.show_favorite_property'); }}">Favorites</a></li>  
                       
                        <li><a href="{{ route('seeker.submit_report'); }}" class="wow fadeInUp animated {{ (request()->is('seeker/submit_report*')) ? 'active' : '' }}">Report</a></li> 
                        <?php } ?> 
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                <div class="single-footer">
                    <h4>Last News</h4>
                    <div class="footer-title-line"></div>
                    <ul class="footer-blog">

                    @foreach($property as $list)
                        <li>
                            <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                                <a href="single.html">
                                    <img src="<?php echo asset('property_img/'.$list->prop_img);?>">
                                </a>
                                <span class="blg-date"><?php echo date_format($list->created_at, 'Y-m-d'); ?></span>

                            </div>
                            <div class="col-md-8  col-sm-8 col-xs-8  blg-entry"  >
                                <h6>  <a href="single.html"> <?php echo ucwords($list->title); ?> </a></h6> 
                                <p> ₱ <?php echo number_format($list->amount,2); ?> </p>
                            </div>
                        </li> 
                    @endforeach  

                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                <div class="single-footer news-letter">
                    <h4>Stay in touch</h4>
                    <div class="footer-title-line"></div>
                    <p>Getting in tocuh with our customer is very important to us. We accept feedback and suggestions for improvement. Feel free to drop any message on our social media account.</p>

                    <div class="social pull-right"> 
                        <ul>
                            <li><a class="wow fadeInUp animated" href="https://twitter.com/kimarotec"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="wow fadeInUp animated" href="https://www.facebook.com/kimarotec" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="wow fadeInUp animated" href="https://plus.google.com/kimarotec" data-wow-delay="0.3s"><i class="fa fa-google-plus"></i></a></li>
                            <li><a class="wow fadeInUp animated" href="https://instagram.com/kimarotec" data-wow-delay="0.4s"><i class="fa fa-instagram"></i></a></li>
                            <li><a class="wow fadeInUp animated" href="https://instagram.com/kimarotec" data-wow-delay="0.6s"><i class="fa fa-dribbble"></i></a></li>
                        </ul> 
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="footer-copy text-center">
    <div class="container">
        <div class="row">
            <div class="pull-left">
                <span> (C) <a href="http://www.KimaroTec.com">Real Estate Application</a> , All rights reserved 2021  </span> 
            </div> 
            <div class="bottom-menu pull-right"> 
                <ul> 
                    <li><a class="wow fadeInUp animated" href="{{ route('home'); }}" data-wow-delay="0.2s">Home</a></li>
                    <li><a class="wow fadeInUp animated" href="{{ route('seeker.properties'); }}" data-wow-delay="0.3s">Properties</a></li>
                    <li><a class="wow fadeInUp animated" href="{{ route('seeker.search_agent'); }}" data-wow-delay="0.4s">Search Agent</a></li>
                    <li><a class="wow fadeInUp animated" href="{{ route('seeker.map'); }}" data-wow-delay="0.6s">Map</a></li>
                </ul> 
            </div>
        </div>
    </div>
</div>

</div>

<script src="{{ asset('seekers_assets/assets/js/modernizr-2.6.2.min.js'); }}"></script>

<script src="{{ asset('seekers_assets/assets/js/jquery-1.10.2.min.js'); }}"></script>
<script src="{{ asset('seekers_assets/bootstrap/js/bootstrap.min.js'); }}"></script>
<script src="{{ asset('seekers_assets/assets/js/bootstrap-select.min.js'); }}"></script>
<script src="{{ asset('seekers_assets/assets/js/bootstrap-hover-dropdown.js'); }}"></script>

<script src="{{ asset('seekers_assets/assets/js/easypiechart.min.js'); }}"></script>
<script src="{{ asset('seekers_assets/assets/js/jquery.easypiechart.min.js'); }}"></script>
<script src="{{ asset('seekers_assets/assets/js/sweetalert.min.js'); }}"></script>

<!-- JQUERY MASKED INPUT --> 
<script src="{{ asset('seekers_assets/assets/js/owl.carousel.min.js'); }}"></script>        

<script src="{{ asset('seekers_assets/assets/js/wow.js'); }}"></script>

<script src="{{ asset('seekers_assets/assets/js/icheck.min.js'); }}"></script>
<script src="{{ asset('seekers_assets/assets/js/price-range.js'); }}"></script>
<script src="{{ asset('seekers_assets/assets/js/jquery-validate.min.js'); }}"></script>
<script src="{{ asset('seekers_assets/assets/js/jquery.mask.min.js'); }}"></script> 

<script src="{{ asset('seekers_assets/assets/js/main.js'); }}"></script>
<?php 
if(!empty(auth()->user())){
if(auth()->user()->rank == '0'){
    
    ?>
			<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="4b1058f9-29fc-445f-bb36-6c7c4a88b164";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
<?php }} ?>

