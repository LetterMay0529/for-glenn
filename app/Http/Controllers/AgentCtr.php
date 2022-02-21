<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Documents;
use App\Models\Broker; 
use App\Models\ReviewAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\PropertyMdl;
use App\Models\Add_Property_Photo;
use Illuminate\Support\Facades\Mail;
use DataTables;
use Session;

class AgentCtr extends Controller
{
    //
    public function view_request_approval(){

        return view('admin.admin-agent-request-approval');

    }

    public function get_all_pending_review(Request $request)
    {
        // composer require yajra/laravel-datatables-oracle:"~9.0"
        if ($request->ajax()) {

            $data = DB::table('request_for_review')
                        ->join('users', 'users.users_id', '=', 'request_for_review.agent_id') 
                        ->select('request_for_review.*','users.users_id','users.firstname', 'users.lastname', 'users.profile_img',DB::raw('users.created_at as account_created'), 'users.phone', 'users.email', 'users.username', 'users.about_me') 
                        ->where('request_for_review.status','=','pending')
                        ->get();
 
            return Datatables::of($data)
                    
                    ->addIndexColumn()
                    ->setRowId(function ($request) {
                        return 'td_'.$request->review_id;
                    })
                    ->editColumn('agent_name', function ($request) {

                        $profile = 'profile_img/avatar-agent.jpg';

                        if($request->profile_img != 'none'){

                            $profile = 'profile_img/'.$request->profile_img;

                        }
                        
                        return  '<div class="row">
                                    <div class="col-md-4">
                                        <img src="'.asset($profile).'" class="img-responsive" alt="img">
                                        </ul>
                                    </div>
                                    <div class="col-md-8 padding-left-0">
                                        <h3 class="margin-top-0"><a href="javascript:void(0);"><p style="font-size: 24px;">'.ucwords($request->firstname).' <strong>'.ucwords($request->lastname).'</strong></p> </a> <small class="font-xs"><i>Account created on <a href="javascript:void(0);">'.date('F d, Y', strtotime($request->account_created)).'</a></i></small></h3>
                    
                                        <ul class="list-unstyled">
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-phone"></i>&nbsp;&nbsp;  '.$request->phone.'
                                                </p>
                                            </li>
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-envelope"></i>&nbsp;&nbsp;  '.$request->email.'
                                                </p>
                                            </li>
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-user"></i>&nbsp;&nbsp;  '.$request->username.' 
                                                </p>
                                            </li>
                                            <li>
                                                <p class="text-muted">
                                                 <i class="fa fa-pencil"></i>&nbsp;&nbsp '.$request->about_me.'
                                                </p>
                                            </li>
                                        </ul> 
                                    </div>
                                </div>'; // human readable format
                    })
                    
                    
                    ->editColumn('date_requested', function ($request) {
                        
                        return "<p style='text-align:center'>".date('F d, Y h:i:s A', strtotime($request->created_at))."</p>";
                        
                     })

                    //39.087089704070706,-16.202957735676108
                    ->addColumn('action', function($row){

                            $users_id = $row->users_id;
                            //$users_id = openssl_encrypt($users_id, 'AES-256-CTR', "vishal", 0, 1234567891234567);

                            $review_id = $row->review_id;
                            //$review_id = openssl_encrypt($review_id, 'AES-256-CTR', "vishal", 0, 1234567891234567);
  
                      $btn = '<ul class="demo-btns btn-group-vertical">  
                                    <li>
                                        <a href="view_agent_profile_review/'.$users_id.'/'.$review_id.'" class="btn btn-labeled btn-primary"  target="_blank"> <span class="btn-label"><i class="glyphicon glyphicon-share"></i></span>Review Account</a>
                                    </li>  
                                </ul>';
                      return $btn;
                    })

                    ->rawColumns(['action','agent_name','date_requested'])
                    ->make(true);

        }

    }

    public function view_agent_profile_review($user_id, $review_id){
 
        $data = DB::table('request_for_review')
        ->join('users', 'users.users_id', '=', 'request_for_review.agent_id') 
        ->select('request_for_review.*','users.users_id','users.firstname', 'users.lastname','users.email_verified_at', 'users.profile_img',DB::raw('users.created_at as account_created'), 'users.phone', 'users.email', 'users.username', 'users.about_me', 'users.date_verified_at') 
        ->where('request_for_review.review_id','=',$review_id)
        ->where('request_for_review.agent_id','=',$user_id)
        ->where('request_for_review.status','=','pending')
        ->get();

        $document = Documents::select('*')
                        ->where('agent_id', '=', $user_id)
                        ->get();
 

        $broker = Broker::select('*')
        ->where('agent_id', '=', $user_id)
        ->get();

        $data_count = DB::table('request_for_review')
        ->join('users', 'users.users_id', '=', 'request_for_review.agent_id') 
        ->select('request_for_review.*') 
        ->where('request_for_review.review_id','=',$review_id)
        ->where('request_for_review.agent_id','=',$user_id) 
        ->get();

        $activity = DB::table('request_for_review')
        ->leftJoin('users', 'request_for_review.review_by', '=', 'users.users_id')
        ->select('request_for_review.*', 'users.firstname','users.lastname', 'users.username', 'users.profile_img')  
        ->where('request_for_review.agent_id','=',$user_id) 
        ->orderBy('request_for_review.created_at', 'desc')
        ->get();
 

        if(count($data) == 0){

            if(count($data_count) == 0){

                $completed = 'false';

            }else{

                $completed = 'true';
               
            }

            //echo "haha";
            return view('admin.error404', compact(array('completed')));
        }else{

            //echo json_encode($activity);
            return view('admin.admin-agent-profile', compact(array('data','document', 'broker', 'activity')));

        }
    }

    public function reject_agent_account(Request $request){

       // details_of_result, status => reject,  review_by(admin who reviewed the account), date reviewed completed
       $validator = Validator::make($request->all(), [ // <---
                'details_of_result'      => 'required',
                'review_id'              => 'required', 
        ]);

        if($validator->fails()){

            echo json_encode($validator->messages()->getMessages());

        }else{

            $review                         = ReviewAccount::find($request->review_id);
            $review->details_of_result      = $request->details_of_result;
            $review->status                 = 'rejected';
            $review->review_by              = auth()->user()->users_id;
            $review->date_review_completed  = date('Y-m-d H:i:s');
            $review->save();

            if($review){

                echo "SUCCESS";
                

            }else{

                echo "FAILED!";

            }

        }


    }

    public function approve_agents_account(Request $request){

        $validator = Validator::make($request->all(), [ // <---
                'details_of_result'      => 'required',
                'review_id'              => 'required', 
        ]);

        if($validator->fails()){

            echo json_encode($validator->messages()->getMessages());

        }else{

            $review                         = ReviewAccount::find($request->review_id);
            $review->details_of_result      = $request->details_of_result;
            $review->status                 = 'completed';
            $review->review_by              = auth()->user()->users_id;
            $review->date_review_completed  = date('Y-m-d H:i:s');
            $review->save();

            if($review){

                $user_id = $request->users_id;

                $user                       = User::find($user_id);
                $user->status             = 'active';
                $user->date_verified_at   =  date('Y-m-d');
                $user->save();

                if($validator->fails()){

                    echo json_encode($validator->messages()->getMessages());
        
                }else{

                    echo "SUCCESS";

                }

            }else{

                echo "FAILED!";

            }

        }
    }

    public function view_agent_list(){

        return view('admin.admin-agent-list');

    }

    public function agent_search_result(Request $request){

         if($request->status_change == 'deactivated'){
            $request->status_change='inactive';
         }

        if($request->status_change == 'all'){

            $keyword = $request->search;

            $result = User::select('*')
                            ->where('rank', '=', $request->rank)
                            ->where(function ($query) use ($keyword)  {

                                $query->where(DB::raw('concat(firstname," ",lastname)'),  'like', '%' . $keyword . '%')
                                    ->orWhere('email', 'like', '%' . $keyword . '%')
                                    ->orWhere('username', 'like', '%' . $keyword . '%');

                            })
                            ->offset($request->offset)
                            ->limit(10)
                            ->get();
            
        }else{
            
            $keyword = $request->search;

            $result = User::select('*')
            ->where('status', '=', $request->status_change)
            ->where('rank', '=', $request->rank)
            ->where(function ($query) use ($keyword)  {

                $query->where(DB::raw('concat(firstname," ",lastname)'),  'like', '%' . $keyword . '%')
                    ->orWhere('email', '=',  'like', '%' . $keyword . '%')
                    ->orWhere('username', '=',  'like', '%' . $keyword . '%');

            })
            ->offset($request->offset)
            ->limit(10)
            ->get();

        }

        //echo json_encode($result);
         
        return view('admin.subpages.admin-search-result', compact(array('result','request')));

    }

    public function deactivate_agents_accounts(Request $request)
    {
        $users_id = $request->deactivate_agent_id;

        $review =  ReviewAccount::create([ 
            'agent_id'              => $users_id,
            'details_of_result'     => $request['details_of_result'],
            'status'                => 'deactivated',
            'review_by'             => auth()->user()->users_id, 
            'date_review_completed' => date('Y-m-d H:i:s')
        ]);


        if($review){

            $agent_data =User::find($users_id);
            $agent_data->status = 'inactive';
            $agent_data->date_verified_at = NULL;
            $agent_data->save();
            
            if($agent_data){

                echo "SUCCESS";

            }else{

                echo "Error on updating agent data! Might be a problem on the db side!"; 

            }

        }else{

            die('Error on deactivating agents account!');

        }

    }

    public function view_property_agent_posted($user_id)
    {
        $data =  DB::table('users')
                    ->where('users_id', $user_id)
                    ->get();

        
        return view('admin.admin-agent_property_posted', compact(array('user_id', 'data')));

    }

    public function get_all_property_posted_agent(Request $request, $user_id)
    {
        // composer require yajra/laravel-datatables-oracle:"~9.0"

        //$user_id = $request->user_id;

        if ($request->ajax()) {
            
            $data = PropertyMdl::select('*')->where('users_id', '=', $user_id)->orderby('created_at', 'DESC');

            return Datatables::of($data)
                    
                    ->addIndexColumn()
                    ->setRowId(function ($request) {
                        return 'td_'.$request->property_id;
                    })
                    ->editColumn('created_at', function ($request) {
                        return $request->created_at->format('F d, Y h:i A'); // human readable format
                    })
                    
                    ->editColumn('title', function ($request) {
                        //return $this->trim_data($request, 'title', 50); 
                        if($request->property_type == 'land'){
                            $acr = "PTL-";
                        }else if($request->property_type == 'commercial'){
                            $acr = "PTC-";
                        }else{
                            $acr = "PTR-";
                        } 

                        $color = '';
                        if($request->property_status == 'availables'){
                            $color = 'green';
                        }else if($request->property_status == 'remove'){
                            $color = 'red';
                        }else{
                            $color = '#0a9ef7f0';
                        }

                        return '<div class="row">
                                    <div class="col-md-3">
                                        <img src="'.asset('property_img/'.$request->prop_img).'" class="img-responsive" alt="img"> 
                                    </div>
                                    <div class="col-md-9 padding-left-0">
                                        <h3 class="margin-top-0">
                                        <a href="javascript:void(0);"> TITLE: '.ucwords($this->trim_data($request, 'title', 50)).' </a>
                                        <br>
                                        </h3>
                                        <p  style="margin:0; "><i>PROPERTY ID: <a href="javascript:void(0);">'.$acr.$request->property_id.'</a></i></p>
                                        <p  style="margin:0; "><i>PRICE: <a href="javascript:void(0);">'."₱ ".number_format((int)$request->amount,2).'</a></i></p>
                                        <p  style="margin:0; "><i>PROPERTY SIZE: <a href="javascript:void(0);">'.number_format((int)$request->property_size).' SQM</a></i></p>
                                        <p style="color:'.$color.'">'.ucwords($request->property_status).'</>
                                        <br>
                                        <p>DESCRIPTION: </p>
                                        <p>
                                            '.$this->trim_data($request, 'description', 500).'
                                        </p> 
                                    </div>
                                </div>';


                     })
                    
                    // ->editColumn('location', function ($request) {
                    //     return $request->location;
                    //  })

                    //39.087089704070706,-16.202957735676108
                    ->addColumn('action', function($row){
                      //  $btn = '<button  data-toggle="modal" onclick="show_details('.$row->property_id.')" class="edit btn btn-primary btn-sm">View Details</button><button class="btn btn-success btn-sm"><i class="fa fa-edit"> Visit  Location</button>';
                           
                      $btn = '<ul class="demo-btns btn-group-vertical">
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-primary" onclick="show_photos('.$row->property_id.',\''.$row->title.'\')"> <span class="btn-label"><i class="glyphicon glyphicon-picture"></i></span> Show photos </a>
                                    </li> 
                                </ul>';
                      return $btn;
                    })

                    ->rawColumns(['action', 'title'])
                    ->make(true);

        }

        

    }

    public function trim_data($request, $attr, $val){

        if (strlen($request->$attr) > $val) {

            $stringCut = substr($request->$attr, 0, $val);
            $endPoint = strrpos($stringCut, ' ');
        
            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            return $string .= '...';
            
        }else{

            return $request->$attr; //$request->date_end->format('Y-m-d'); // human readable format

        }
    }

    public function get_photos_carousel(Request $request){

        $photo_result =  DB::table('property_photo')
                        ->join('property', 'property.property_id', '=', 'property_photo.property_id')
                        ->select('property_photo.*','property.title', 'property.amount')
                        ->where('property_photo.property_id', '=', $request->property_id)
                        ->get();

        //echo json_encode($photo_result);
        return view('admin.subpages.admin-photo-carousel', compact(array('photo_result')));

    }

    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function reset_password(Request $request){
        
       $new_password =  $this->randomPassword();

        $user = User::find($request->user_id);
        $user->password = bcrypt($new_password);
        $user->save();

        if($user){

            $to_name = "REAL ESTATE APP";
            $to_email = $request->email;
    
            $data = array('name'=> ucwords($request->firstname), 'body' => 'To login to your account, we reset your password as requested. Please use this auto generated password to login to your account.',  'new_password' => $new_password);

            Mail::send('emails.password', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('REAL ESTATE NEW PASSWORD');
                $message->from('realestateapp21@gmail.com','REAL ESTATE PORTAL CODE');
            });

            // check for failures
            if (Mail::failures()) {

                echo "FAILED";

            }else{
                
                echo "SUCCESS";

            }

        }else{
            echo "Failed updating password on user!";
        }

        

    }

}
