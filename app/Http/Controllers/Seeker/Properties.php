<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyMdl;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;

class Properties extends Controller
{
    public function properties(){

        $maximum_prop_amount    = DB::table('property')->max('amount');
        $maximum_prop_size      = DB::table('property')->max('property_size');

        $data = PropertyMdl::select('*')
                        ->where('property_status', '=', 'availables')
                        ->limit(5)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $recommended = [];

        foreach($data as $list)
        {
            $recommended[] = array(
                'property_id' => $list['property_id'],
                'title'     => $this->trim_data($list['title'], 40),
                'amount'    => $list['amount'],
                'prop_img'  => $list['prop_img']
            );
        }

        //echo json_encode($recommended);
 
       return view('seekers.properties',compact('recommended', 'maximum_prop_amount', 'maximum_prop_size'));
        
    }

    public function render_property_pages(){

       

        return view('seekers.sub_pages.property_pages_list');
        //return view('seekers.sub_pages.property_list');

    }

    public function render_property_list(){

        $maximum_prop_amount    = DB::table('property')->max('amount');
        $maximum_prop_size      = DB::table('property')->max('property_size');

        $properties = $this->get_property_result($page_num = 9, 
                                                    $orderd_by = 'ASC', 
                                                    $ordered_attr = 'created_at',
                                                    $status = 'availables',
                                                    $minAmt = 0,
                                                    $maxAmt = $maximum_prop_amount,
                                                    $minSize = 0,
                                                    $maxSize = $maximum_prop_size,
                                                    $search = '',
                                                    $offset = 0);
        $count = $this->get_property_count(
                                        $orderd_by = 'ASC', 
                                        $ordered_attr = 'created_at',
                                        $status = 'availables',
                                        $minAmt = 0,
                                        $maxAmt = $maximum_prop_amount,
                                        $minSize = 0,
                                        $maxSize = $maximum_prop_size,
                                        $search = ''
        );
       
        //echo json_encode($properties);
        //$page_num = $count;
 

        return view('seekers.sub_pages.property_list', compact(array('properties', 'count', 'page_num'))); 
    }

    public function get_property_count( $orderd_by = 'ASC', 
                                        $ordered_attr = 'created_at',
                                        $status = 'availables',
                                        $minAmt = 0,
                                        $maxAmt = 600,
                                        $minSize = 0,
                                        $maxSize = 600,
                                        $search = ''){

         return  $count = PropertyMdl::select('*')
                            ->where('property_status', '=', $status)
                            ->where(function ($query) use ($minAmt, $maxAmt){ 
                                        $query->where('amount', '>=', $minAmt)
                                                ->where('amount', '<=', $maxAmt);
                            })
                            ->where(function ($query) use ($minSize, $maxSize){ 
                                $query->where('property_size', '>=', $minSize)
                                        ->where('property_size', '<=', $maxSize);
                            })
                            ->where('title','like','%'.$search.'%')
                            ->orderBy($ordered_attr, $orderd_by) 
                            ->count();
    }

    public function get_property_result($page_num = 9, 
                                        $orderd_by = 'ASC', 
                                        $ordered_attr = 'created_at',
                                        $status = 'availables',
                                        $minAmt = 0,
                                        $maxAmt = 1000000,
                                        $minSize = 0,
                                        $maxSize = 1000000,
                                        $search = '',
                                        $offset = 0){

            $data = PropertyMdl::select('*')
                            ->where('property_status', '=', $status)
                            ->where(function ($query) use ($minAmt, $maxAmt){ 
                                        $query->where('amount', '>=', $minAmt)
                                                ->where('amount', '<=', $maxAmt);
                            })
                            ->where(function ($query) use ($minSize, $maxSize){ 
                                $query->where('property_size', '>=', $minSize)
                                        ->where('property_size', '<=', $maxSize);
                            })
                            ->where('title','like','%'.$search.'%')
                            ->orderBy($ordered_attr, $orderd_by)
                            ->offset($offset)
                            ->limit($page_num)
                            ->get();
        $properties = [];

        foreach($data as $list){

            $properties[] = array(
                'property_id' => $list->property_id,
                'title' =>   $this->trim_data($list->title, 20),
                'amount' => $list->amount,
                'property_size' => $list->property_size,
                'prop_img' => $list->prop_img
            );
        }

        return $properties;

    }

    public function search_filter_data_properties(Request $request){

        $page_num = $request->items_per_page;
        $sort = explode(",", $request->orderBy);
        $orderd_by = $sort[1];
        $ordered_attr = $sort[0];
        $status = $request->status;
        $amount = explode(",", $request['price-range']);
        $minAmt = $amount[0];
        $maxAmt = $amount[1];
        $search = $request->search;
        $size = explode(",", $request['area_size']);
        $minSize = $size[0];
        $maxSize = $size[1];
        $offset  =$request->offset;

        $properties = $this->get_property_result(
            $page_num, 
            $orderd_by, 
            $ordered_attr,
            $status,
            $minAmt,
            $maxAmt,
            $minSize,
            $maxSize,
            $search,
            $offset
        );
 

        //echo json_encode($properties);

        $maximum_prop_amount    = DB::table('property')->max('amount');
        $maximum_prop_size      = DB::table('property')->max('property_size'); 


        $count = $this->get_property_count( $orderd_by, 
                                            $ordered_attr,
                                            $status,
                                            $minAmt,
                                            $maximum_prop_amount,
                                            $minSize,
                                            $maximum_prop_size,
                                            $search ); 
        //$count = 100;

        if($count == 0){

            echo "<div style='padding: 20px; border: 1px solid grey; text-align: center; clear: both'>No properties found!</div>";

        }else{
            //echo json_encode($properties);
          return view('seekers.sub_pages.property_list', compact(array('properties','count', 'page_num')));

        }
        
    }

    public function trim_data($string, $val){

        if (strlen($string) > $val) {

            $stringCut = substr($string, 0, $val);
            $endPoint = strrpos($stringCut, ' ');
        
            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            return $string .= '...';
            
        }else{
            return $string; //$request->date_end->format('Y-m-d'); // human readable format
        }
    }

    public function property_details(Request $request){

        $prop_id = $request->id;

       $result = DB::table('property')->select('property.*','users.firstname', 'users.lastname', 'users.profile_img', 'users.phone', 'users.email', 'users.username', 'users.about_me') 
                ->join('users', 'users.users_id', '=', 'property.users_id') 
                ->where('property_id', '=', $prop_id)
                ->get();

                

        if(count($result)){

            $data = PropertyMdl::select('*')
                        ->where('property_status', '=', 'availables')
                        ->limit(10)
                        ->orderBy('created_at', 'desc')
                        ->get();

            $recommended = [];

            foreach($data as $list)
            {
                $recommended[] = array(
                    'property_id' => $list['property_id'],
                    'title'     => $this->trim_data($list['title'], 40),
                    'amount'    => $list['amount'],
                    'prop_img'  => $list['prop_img']
                );
            }

            $photos = DB::table('property_photo')->select('image_name')
                                                 ->where('property_id', '=', $result[0]->property_id)
                                                 ->get();

            return view('seekers.property',compact(array('result','photos', 'recommended', 'prop_id')));

        }else{

            echo "404 not found";

        }
    }

    public function add_items_favorite(Request $request){

        $prop_id = $request->prop_id;

        if(empty(auth()->user())){
            die('LOGIN');
        }

        $res = Favorite::select('*')
                            ->where('customer_id', '=', auth()->user()->users_id)
                            ->where('property_id', '=', $prop_id)
                            ->count();
        if($res > 0){

            die('ADDED');
            
        }

       $response =  Favorite::create([
                    'customer_id'  => auth()->user()->users_id, 
                    'property_id' => $prop_id 
                ]);
        if($response){
            echo "SUCCESS";
        }else{
            echo "Failed!";
        }
    }

    public function map(){

        $data = PropertyMdl::select('*')
                        ->where('property_status', '=', 'availables')
                        ->get();

        $geo_data = [];

         foreach($data as $list){

            $location = explode(',',$list->location);
            
            $lat = (float)$location[1];
            $long =  (float)$location[0];
 
            $geo_data[] = array(

                'type' => 'Feature',
                'properties'=> array(
                        'prop_id' => $list->property_id,
                        'title'=> 'Mapbox DC',
                        'message' =>'Foo',
                        'title' => ucwords($list->title),
                        'iconSize'=> [60, 60]
                ),
                'geometry'=> array(

                    'type'=> 'Point',
                    'coordinates'=> [$lat, $long]

                )
            );

         }

         $geojson = array(
             'Feature' => 'FeatureCollection',
             'features' => $geo_data
         );
        

        return view('seekers.map', compact(array('geojson')));
    }
 
}
