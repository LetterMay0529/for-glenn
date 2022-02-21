<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Admin\AdminModel;
use App\Models\PropertyMdl;
use DataTables;
use Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //$this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    #========= END GENERAL ADMIN CREATED FUNCTIONS==================
        
    #========= START ADMIN CREATED FUNCTION ========================
    public function admin_dashboard()
    {
        
        return view('admin.admin-dashboard');
        
    } 
    #========= END ADMIN CREATED FUNCTION ==========================

    #========= START AGENT CREATED FUNCTION =======================
    public function agent_dashboard()
    {
        //echo "admin agent";
        return view('admin.client.agent-dashboard');
    }

    public function agent_verify_email(){
        $to_name = "REAL ESTATE APP";
        $to_email = auth()->user()->email;

        $pincode = random_int(100000, 999999);
        $data = array('name'=> ucwords(auth()->user()->firstname), 'body' => 'To continue your email verification, please enter the following code',  'pincode' => $pincode);

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('REAL ESTATE VERIFICATION CODE');
            $message->from('realestateapp21@gmail.com','REAL ESTATE PORTAL CODE');
        });

         // check for failures
        if (Mail::failures()) {

            echo "FAILED";

        }else{
             session(['pincode' => $pincode]);
             session(['time_pin_sent' =>time()]);
             return view('admin.client.modal.email_verify'); 
        }
    }


    public function verify_pin_received(Request $request){

        $pincode = $request->pincode;

        if (Session::get('time_pin_sent') && (time() - Session::get('time_pin_sent') > 300 )){

            //gives 5 minute expiration once the pincode was sent to email
            Session::forget('pincode');

        }else{

            Session::get('time_pin_sent');
            if($pincode == Session::get('pincode')){

                $user  = User::find(auth()->user()->users_id);
                $user->email_verified_at = date('Y-m-d');
                $user->save();

                echo "SUCCESS";

            }else{

                echo "Pincode is incorrect or expired!";

            }

        }
    }

    public function upload_photo_user(Request $request)
    {

        //Email: realestateapp21@gmail.com //password: realEstateapp
      
        $validator = Validator::make($request->all(), [ // <---
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if($validator->fails()){
            return back()
            ->with('error','Image did not meet profile photo requirements.')
            ->with('title', 'Upload Failed');
        }

        $imageName = time().'.'.$request->profile_img->getClientOriginalExtension() ; //$request->image->extension();  
        $request->profile_img->move(public_path('profile_img'), $imageName);
  
        /* Store $imageName name in DATABASE from HERE */
        DB::table('users')
                ->where('users_id', auth()->user()->users_id)
                ->update(['profile_img' => $imageName]);
                
        return back()
            ->with('success','You have successfully upload image.')
            ->with('title', 'Upload Success')
            ->with('image',$imageName);
    }

    public function show_properties(Request $request)
    {
        

        $data = DB::table('property')
                    ->join('users', 'users.users_id', '=', 'property.users_id')
                    ->select(DB::raw('COUNT(property.property_id) as count_property'))
                    ->where('property.users_id', '=', auth()->user()->users_id)
                    ->where(function ($query) {
                        $a_date =  date("Y-m-d");
                        $query->where('property.created_at', '>=', date('Y-m-01', strtotime(date("Y-m-d"))))
                              ->where('property.created_at', '<=', date("Y-m-t", strtotime(date("Y-m-d"))));
                    })
                    ->get();
                     
        $membership_stat = DB::table('subscription')
                                ->select(DB::raw('COUNT(subscription_id) as count_membership'))
                                ->where('users_id', '=', auth()->user()->users_id)
                                ->where('status', '=', 'active')
                                ->get();

        $count = $data[0]->count_property;
        $status_active = $membership_stat[0]->count_membership;

        //SELECT property.*, CONCAT(users.firstname, ' ', users.lastname)AS fullname FROM `property` JOIN `users` WHERE property.users_id = '1' AND property.users_id = users.users_id AND (property.created_at >= '2021-10-01' AND property.created_at <= '2021-10-30') 

        //DB::raw('COUNT(issue_subscriptions.issue_id) as followers'))

        return view('admin.client.agent-property-listing', compact(array('count','status_active')));
    }

    public function get_all_property_posted(Request $request)
    {
        // composer require yajra/laravel-datatables-oracle:"~9.0"
        if ($request->ajax()) {

            $data = PropertyMdl::select('*')->where('users_id', auth()->user()->users_id)->where('property_status', '!=', 'remove');

            return Datatables::of($data)
                    
                    ->addIndexColumn()
                    ->setRowId(function ($request) {
                        return 'td_'.$request->property_id;
                    })
                    ->editColumn('property_id', function ($request) {
                        if($request->property_type == 'land'){
                            $acr = "PTL-";
                        }else if($request->property_type == 'commercial'){
                            $acr = "PTC-";
                        }else{
                            $acr = "PTR-";
                        }
                        return $acr.$request->property_id; // human readable format
                    })
                    
                    ->editColumn('created_at', function ($request) {
                        return $request->created_at->format('Y-m-d'); // human readable format
                    })
                    
                    ->editColumn('title', function ($request) {
                        return $this->trim_data($request, 'title', 50); 
                     })
                    ->editColumn('description', function ($request) {
                       return $this->trim_data($request, 'description', 100); 
                    })
                    ->editColumn('amount', function ($request) {
                        return "₱ ".number_format((int)$request->amount,2); // human readable format
                    })
                    ->editColumn('property_status', function ($request) {
                        if($request->property_status == 'availables'){
                            $color = 'green';
                        }else if($request->property_status == 'remove'){
                            $color = 'red';
                        }else{
                            $color = 'yellow';
                        }

                        return '<span class="badge pull-right inbox-badge bg-color-'.$color.'">'.ucwords($request->property_status).'</span>'; 
                     })
                    ->editColumn('location', function ($request) {
                        
                        #=============START DO NOT DELETE THIS ===================
                        // $geolocation = explode(",",$request->location);
                        // $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/".$geolocation[1]."5%2C".$geolocation[0].".json?access_token=pk.eyJ1Ijoia2F5b2cxMjMiLCJhIjoiY2t1OGVnbTJ4MHFmdDJ4cDdzaWgzMjg2aCJ9.6YfOKmagqq-4J2zl2dnmGg&limit=1";
                        // $json = file_get_contents($url);
                        // $json = json_decode($json, true);

                        // if(empty($json['features'])){
                        //     $place = "No data available";
                        // }else{
                        //     $place = $json['features'][0]['place_name'];
                        //     if ($place != ''){
                        //         $place = $json['features'][0]['place_name'];
                        //     }else{
                        //         $place = "No data available";
                        //     }

                        // }
                        // return $place;
                         #=============END DO NOT DELETE THIS ===================
                        return $request->location;
                        
                     })

                    //39.087089704070706,-16.202957735676108
                    ->addColumn('action', function($row){
                      //  $btn = '<button  data-toggle="modal" onclick="show_details('.$row->property_id.')" class="edit btn btn-primary btn-sm">View Details</button><button class="btn btn-success btn-sm"><i class="fa fa-edit"> Visit  Location</button>';
                           
                      $btn = '<ul class="demo-btns btn-group-vertical">
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-primary" onclick="show_details('.$row->property_id.')"> <span class="btn-label"><i class="glyphicon glyphicon-edit"></i></span> Update Info </a>
                                    </li>
                                    <li>
                                        <a href="/seeker/properties/'.$row->property_id.'" class="btn btn-labeled btn-success" target="_blank"> <span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>View Details</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-default" onclick="add_more_photos('.$row->property_id.')" > <span class="btn-label"><i class="glyphicon glyphicon-picture"></i></span>Add Images</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-danger" onclick="remove_properties('.$row->property_id.', \''.$row->title.'\')"> <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Remove</a>
                                    </li>
                                </ul>';
                      return $btn;
                    })

                    ->rawColumns(['action','property_status'])
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

    public function view_property_by_id(Request $request){

        $prop_id =  $request->id;

        $data = DB::table('property')->where('property_id',  $prop_id)->get();

        //echo json_encode($data);

        return view('admin.client.modal.view_property')->with('data', $data);
       // echo "HAHAHAHAHAHAHA";
    }

    
    public function add_properties(Request $request)
    {
        $validator = Validator::make($request->all(), [ // <---
            'title'         => 'required',
            'description'   => 'required',
            'property_type' => 'required',
            'amount'        => 'required|max:9', 
            'size'          => 'required|max:9',
            'longitude'     => 'required',
            'latitude'      => 'required',
            'property_img'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if($validator->fails()){
        
        /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
        echo json_encode($validator->messages()->getMessages());

        }else{

            $imageName = time().'.'.$request->property_img->getClientOriginalExtension() ; //$request->image->extension();  
    
            $request->property_img->move(public_path('property_img'), $imageName);
      
            /* Store data to DB -> property */
           $property =  PropertyMdl::create([
                'title'         => ucwords($request['title']),
                'users_id'      => auth()->user()->users_id,
                'description'   => $request['description'],
                'amount'        => $request['amount'],
                'prop_img'      => $imageName,
                'property_status' => 'availables',
                'property_type' => $request['property_type'],
                'property_size' => $request['size'],
                'location'      => $request['latitude'].','.$request['longitude']
            ]);

            if($property){

                //echo 'Information added to database!';
                echo 'SUCCESS';

            }else{

                echo 'Saving to database error. Please try again!';

            }

        }

        
    }


    public function remove_properties(Request $request){
                
                    $property  = PropertyMdl::find($request->prop_id);
                    $property->property_status = 'remove';
                    $property->save();

        $result = json_encode($property);


    }

    public function update_property_details(Request $request){

        $data = array( 
            'title_update'         => 'required',
            'description_update'   => 'required',
            'property_type_update' => 'required',
            'amount_update'        => 'required|max:9', 
            'size_update'          => 'required|max:9',
            'longitude_update'     => 'required',
            'latitude_update'      => 'required',
          );

        if(!empty($request->property_img_update)){

            $data['property_img_update'] =  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';

        }

        $validator = Validator::make($request->all(), $data);

            if($validator->fails()){
        
            /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
            echo json_encode($validator->messages()->getMessages());
    
            }else{
                 

                $property  = PropertyMdl::find($request->property_id_update);
                $property->title = ucwords($request['title_update']);
                $property->description = $request['description_update'];
                $property->property_status  = $request['property_status_update'];
                $property->amount  = $request['amount_update'];
                $property->property_size  = $request['size_update'];
                $property->property_type    = $request['property_type_update'];
                $property->location = $request['latitude_update'].','.$request['longitude_update'];
                
                if(!empty($request->property_img)){

                    $imageName = time().'.'.$request->property_img_update->getClientOriginalExtension() ; //$request->image->extension();  
                    $request->property_img_update->move(public_path('property_img_update'), $imageName);
                    $property->prop_img = $imageName;

                }

                $property->save();

            
                if($property){
    
                    //echo 'Information added to database!';
                    echo 'SUCCESS';
    
                }else{
    
                    echo 'Saving to database error. Please try again!';
    
                }
    
            }
        
    }
    #========= END AGENT CREATED FUNCTION =========================
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\AdminModel  $adminModel
     * @return \Illuminate\Http\Response
     */
    public function show(AdminModel $adminModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\AdminModel  $adminModel
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminModel $adminModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\AdminModel  $adminModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminModel $adminModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\AdminModel  $adminModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminModel $adminModel)
    {
        //
    }
}
