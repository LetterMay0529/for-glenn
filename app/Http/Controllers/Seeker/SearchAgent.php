<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SearchAgent extends Controller
{
    public function search_agent(){

        return view('seekers.search_agent');

    }

    public function query_agents(Request $request){

        if ($request->ajax()) {
            
            $data = User::select('*')
                        ->where('rank', '=', '1')
                        ->get();

            return Datatables::of($data)
                    
                    ->addIndexColumn()
                    ->setRowId(function ($request) {
                        return 'td_'.$request->users_id;
                    }) 
                    
                    ->editColumn('user', function ($request) { 

                        if($request->profile_img == 'none'){

                            $profile = 'avatar-agent.jpg';

                        }else{

                            $profile = $request->profile_img;

                        } 

                        return '<div class="row">
                                        <div class="clear">
                                            <div class="col-xs-4 col-sm-4 dealer-face">
                                                <a href="">  
                                                    <img src="'.asset('profile_img/'.$profile).'" class=" ">
                                                </a>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 ">
                                                <h3 class="dealer-name">
                                                    <a href=""> '.$request->firstname.' '.$request->lastname.' </a>
                                                    </br>
                                                    <span>Real Estate Agent</span>        
                                                </h3>
                                                <div class="clear">
                                                    <ul class="dealer-contacts">                                       
                                                        <li><i class="pe-7s-user strong"> </i> '.ucwords($request->firstname.' '.$request->lastname).'</li>
                                                        <li><i class="pe-7s-mail strong" > </i><a   href="mailto:'.$request->email.'"> '.$request->email.'</a></li>
                                                        <li><i class="pe-7s-call strong"> </i> + '.$request->phone.'</li>
                                                    </ul> 
                                                </div>

                                            </div>
                                        </div> 
                                </div>'; 

                     })
                     
                    ->addColumn('action', function($row){ 
                        
                      $btn = '  <a href="/seeker/search-agent/profile/'.$row->users_id.'" class="btn btn-labeled btn-primary" onclick=""> <span class="btn-label"><i class="glyphicon glyphicon-picture"></i></span> Visit Profile </a>';
                      return $btn;
                    })

                    ->rawColumns(['action', 'user'])
                    ->make(true);

        }
    }
    public function view_agent_profile(Request $request){

            $users_id =  $request->agent_id;

            $user = User::select('*')->where('users_id','=',$users_id)->first(); 

            if(empty($user)){

                echo "404 not found";
               

            }else{
                
               
               // echo json_encode($result);
               return view('seekers.agent_profile',compact(array('user', 'users_id')));

            }

          
    }

    public function query_agent_posted(Request $request){

        $users_id = $request->users_id;

        if ($request->ajax()) {

            $data =  DB::table('property')->select('*')
                            ->where('users_id','=', $users_id)
                            ->where('property_status', '!=', 'remove')
                            ->get();

            return Datatables::of($data)
                    
                    ->addIndexColumn()
                    ->setRowId(function ($request) {
                        return 'td_'.$request->property_id;
                    }) 
                    
                    ->editColumn('users_id', function ($request) {  

                        return ' 
                                <div class="  proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="'.asset('property_img/'.$request->prop_img).'"></a>
                                        </div>
                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> '.ucwords($request->title).' </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Area :</b> '.number_format($request->property_size).'</span>
                                            <span class="proerty-price pull-right"> ₱ '.number_format($request->amount).'</span> 
                                            <p  class="description">'.ucfirst($this->trim_data($request->description, 300)).'</p> </div>
                                            <div class="property-icon"> 
                                                <div class="pull-right">     
                                                    <a href="/seeker/properties/'.$request->property_id.'" class="button"><button class="btn btn-primary">View</button></a>
                                                </div>
                                            </div>  
                                        </div>
                                    </div> 
                        '; 

                    }) 

                    ->rawColumns(['users_id'])
                    ->make(true);

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
}
