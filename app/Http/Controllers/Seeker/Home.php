<?php

namespace App\Http\Controllers\Seeker;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\PropertyMdl; 
use Illuminate\Support\Facades\DB;

class Home extends Controller
{


    public function __construct()
    {   
        //$this->middleware('seeker');
    }

    public function index(){ 

        $data = [];
        
        $property = PropertyMdl::select('property_id','title', 'amount', 'property_size','prop_img')
                            ->where('property_status','=','availables')
                            ->orderBy('created_at','ASC')
                            ->limit(7)
                            ->get();
        $avail_prop = DB::table('property')->where('property_status','=', 'availables')->count();

        foreach($property as $list){

            $data[] = array(
                'property_id'   => $list['property_id'],
                'title'         => $this->trim_data($list['title'], 22),
                'price'         => '₱ '.number_format($list['amount'],2),
                'property_size' => number_format($list['property_size'],2).' M2',
                'prop_img'      => $list['prop_img']
            );

        }

        //echo json_encode($data);
        return view('seekers.home',compact(array('data','avail_prop'))); 
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

}
