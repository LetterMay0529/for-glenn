@include('seekers.layouts.header') 

        <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">List of properties</h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="properties-area recent-property" style="background-color: #FFF;">
            <div class="container">  
                <div class="row">
                     
                <div class="col-md-3 p0 padding-top-40">
                    <div class="blog-asside-right pr0">
                        <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
                            <div class="panel-heading">
                                <h3 class="panel-title">Smart search</h3>
                            </div>
                            <div class="panel-body search-widget">
                                <form id="form_filter"class=" form-inline" > 
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="search_word"placeholder="Search property name...">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="row">
                                            
                                            <input type="hidden" value="0" id="offset_start">
                                            <div class="col-xs-12">

                                                <select id="status_id" class="selectpicker show-tick form-control">
                                                    <option> -Status- </option>
                                                    <option selected="selected" value="availables">Available </option>
                                                    <option value="sold">Sold</option>
                                                    <!-- <option>Removed</option>   -->

                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="padding-5">
                                        <div class="row"> 
                                                <label for="price-range">Price range ($):</label>
                                                <input type="text" class="span2" value="0,<?php echo $maximum_prop_amount; ?>" data-slider-min="0" 
                                                       data-slider-max="<?php echo $maximum_prop_amount; ?>" data-slider-step="5" 
                                                       data-slider-value="[0,<?php echo $maximum_prop_amount; ?>]" id="price-range-2" ><br />
                                                <b class="pull-left color">0</b> 
                                                <b class="pull-right color"><?php echo number_format($maximum_prop_amount); ?></b>                                       
                                        </div>
                                        <div class="row">
                                                <label for="property-geo">Area Size:</label>
                                                <input type="text" class="span2" value="0,<?php echo $maximum_prop_size; ?>" data-slider-min="0" 
                                                       data-slider-max="<?php echo $maximum_prop_size; ?>" data-slider-step="5" 
                                                       data-slider-value="[0,<?php echo $maximum_prop_size; ?>]" id="area_size" ><br />
                                                <b class="pull-left color">0 SQM</b> 
                                                <b class="pull-right color"><?php echo number_format($maximum_prop_size); ?> SQM</b>
                                        </div>
                                    </fieldset>                                

                                    <fieldset >
                                        <div class="row">
                                            <div class="col-xs-12">  
                                                <input class="button btn largesearch-btn" value="Search" type="submit">
                                            </div>  
                                        </div>
                                    </fieldset>                                     
                                </form>
                            </div>
                        </div>

                        <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                            <div class="panel-heading">
                                <h3 class="panel-title">Recommended</h3>
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
                    </div>
                </div>

                <div class="col-md-9  pr0 padding-top-40 properties-page">
                    <div class="col-md-12 clear"> 
                        <div class="col-xs-10 page-subheader sorting pl0">
                            <input type="hidden" value="created_at,ASC" id="sort_value"/>
                            <ul class="sort-by-list">
                                <li class="active" id="li_date">
                                    <a href="javascript:void(0);" class="order_by_date" data-orderby="property_date" onclick="select_date_order()" data-order="ASC">
                                        Property Date <i class="fa fa-sort-amount-asc"></i>					
                                    </a>
                                </li>
                                <li class="" id="li_price">
                                    <a href="javascript:void(0);" class="order_by_price" onclick="select_price_order()" data-orderby="property_price" data-order="DESC">
                                        Property Price <i class="fa fa-sort-numeric-desc"></i>						
                                    </a>
                                </li>
                            </ul><!--/ .sort-by-list-->

                            <div class="items-per-page">
                                <label for="items_per_page"><b>Property per page :</b></label>
                                <div class="sel">
                                    <select id="items_per_page" name="per_page" onchange="get_data();">
                                        <option value="3">3</option>
                                        <option value="6">6</option>
                                        <option selected="selected" value="9">9</option>
                                        <option value="12">12</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                        <option value="60">60</option>
                                    </select>
                                </div><!--/ .sel-->
                            </div><!--/ .items-per-page-->
                        </div>
 
                    </div>

<!-- ----------- START PAGINATION AND PROPERTIES SHOULD BE RENDERED ----------- -->
                    <div id='pages_list' class="proerty-th">

                    </div>

<!-- ----------- END PAGINATION AND PROPERTIES SHOULD BE RENDERED ----------- -->
                </div>  
                </div>              
            </div>
        </div>


@include('seekers.layouts.footer');
<script>

    function select_price_order(){ 
        $('#sort_value').val('amount,DESC')

        $("#li_date").removeClass('active');
        $("#li_price").stop().animate();
        $("#li_price").addClass('active');

        get_data();
    }
    function select_date_order(){ 

        $('#sort_value').val('created_at,ASC')

        $("#li_price").removeClass('active');
        $("#li_date").stop().animate();
        $("#li_date").addClass('active');

        get_data();

    }

    $(document).ready(function(){ 

        $('#area_size').slider({ values: [ 10, 25 ] });
        $('#price-range-2').slider({ values: [ 10, 25 ] });
                        

        var loading = '<div class="" style="padding: 50px; text-align:center"><p>Loading ... </p></div>';

        $('#pages_list').html(loading);

        $.ajax({
            url: '<?php echo route('seeker.render_property_list'); ?>',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'GET',
            success: function(data){
                $('#pages_list').html(data);
            },
            error: function(err){

                console.log(err);
                
            }
        });

        $('#form_filter').on('submit', function(event){

            event.preventDefault();
            document.getElementById('offset_start').value = '0';
            get_data();

        }); 


    });


    function get_data( offset = 0){

            var items_per_page = document.getElementById('items_per_page').value;
            var area_size = document.getElementById('area_size').value;
            var price_range = document.getElementById('price-range-2').value;
            var status = $('#status_id').val();
            var search = $('#search_word').val();
            var orderBy = $('#sort_value').val();
            var offset = $('#offset_start').val();

            var loading = "<div style='padding: 20px; border: 1px solid grey; text-align: center; clear: both'>Loading...</div>";
            
            $('#pages_list').html(loading);

            $.ajax({
                url: "{{ route('seeker.search_filter_data_properties')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "POST",
                data: {
                    "items_per_page": items_per_page,
                    "area_size" :area_size,
                    "price-range" : price_range,
                    "status" : status,
                    "search" : search,
                    "orderBy": orderBy,
                    "offset" : offset
                },
                success: function(data){ 

                        $('#pages_list').html(data);

                }
            });

    }
</script>

</body>
</html>