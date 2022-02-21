<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\User;
use App\Models\PropertyMdl;

use DataTables;

class AppointmentCtr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function add_appointments()
    {
        return view('admin.client.agent-add-appointment');
    }

    public function query_active_seekers(Request $request){

        $search = $request->search;

        if($search == ''){

            $users = User::select('users_id','firstname','lastname')
                        ->where('rank', '=', 0) 
                        ->where('status','active')
                        ->limit(5)
                        ->get();

        }else{

            $users = User::select('users_id','firstname','lastname','profile_img')
                        ->where('rank', '=', 0)
                        ->where('firstname', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('lastname', 'LIKE', '%' . $request->search . '%')
                        ->where('status','active')
                        ->limit(5)
                        ->get();
        }

        return response()->json($users); 
    }

    public function query_active_properties(Request $request){

        $search = $request->search;

        // if($search == ''){

        //     $users = PropertyMdl::select('property_id','title','location','description', 'prop_img')
        //                 ->where('title', 'LIKE', '%' . $request->search . '%') 
        //                 ->where('property_status', '!=', 'remove')
        //                 ->limit(5)
        //                 ->get();

        // }else{

        //     $users = PropertyMdl::select('property_id','title','location','description', 'prop_img')
        //                 ->where('title', 'LIKE', '%' . $request->search . '%') 
        //                 ->limit(5)
        //                 ->get();
        // }

        $users = PropertyMdl::select('property_id','title','location','description', 'prop_img')
                        ->where('title', 'LIKE', '%' . $request->search . '%') 
                        ->where('property.property_status' ,'=', 'availables')
                        ->limit(5)
                        ->get();
        

        return response()->json($users); 
    }

    public function create_apt_insert(Request $request){

        $data = $request->all();

        $validator = Validator::make($data, [ // <---
            'client_id'     => 'required', 
            'prop_id'       => 'required',
            'message_desc'  => 'required', 
            'date_apt'      => 'required',
            'time_apt'      => 'required',
        ]);

        if($validator->fails()){
        
            /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
            echo json_encode($validator->messages()->getMessages());

        }else{

            $originalDate = "2010/03/21";
            $newDate = date("Y-m-d", strtotime($request['date_apt']));
            //convert from 12 hours to 24 hours
            $time = date("H:i:s", strtotime($request['time_apt']));

            $date_schedule = $newDate.' '.$time;

            $apt_data =  Appointment::create([ 
                'agent_id'      => auth()->user()->users_id,
                'seekers_id'    => $request['client_id'],
                'prop_id'       => $request['prop_id'],
                'message_desc'  => $request['message_desc'],
                'date_scheduled'=> date("Y-m-d H:i:s", strtotime($date_schedule))
            ]);
            //echo date("Y-m-d H:i:s", strtotime($date_schedule));

            if($apt_data){
                echo "SUCCESS";
            }else{
                echo "FAILED";
            }
        }

        
    }

    public function view_appointment(){

        $result_apt = DB::table('appointments')
                        ->select('appointments.date_scheduled','appointments.message_desc','users.firstname', 'users.lastname', 'property.title')
                        ->join('users','users.users_id','=','appointments.seekers_id')
                        ->join('property','property.property_id','=','appointments.prop_id')
                        ->where('appointments.agent_id' ,'=', auth()->user()->users_id)
                        ->get();
        //echo json_encode($result_apt);

        $event = array();

        foreach($result_apt as $res){

            $event[] = array(
                'title'         => 'Client Name: '.$res->firstname.' '.$res->lastname,
                'property'=> 'Property Title: '.$res->title.'<br>'.'<span class="label bg-color-green txt-color-white">Date & Time Schedule:</span> '.date('D, M j, Y \a\t g:ia', strtotime($res->date_scheduled))."<br><br>"."Description: ".$res->message_desc, 
                'start'         =>$res->date_scheduled,
                'description'   => "Description: ".$res->message_desc,
                'className'     => array('event', 'bg-color-greenLight'),
                'icon'          => 'fa-check'
            
            );  

        }

        $jsonData = collect($event)->toJson();
        
        return view('admin.client.agent-view-appointment', compact('jsonData'));
    }

    public function view_apt_ajax(Request $request){

        // composer require yajra/laravel-datatables-oracle:"~9.0"                       
        if ($request->ajax()) {

            $data = Appointment::select(DB::raw('CONCAT(users.firstname, ", ", users.lastname) AS client_name'),  'property.title', 'appointments.date_scheduled','appointments.message_desc', 'appointments.apt_id')
                                    ->join('users','users.users_id','=','appointments.seekers_id')
                                    ->join('property','property.property_id','=','appointments.prop_id')
                                    ->where('appointments.agent_id' ,'=', auth()->user()->users_id)
                                    ->get();
            
            return Datatables::of($data)
                    
                    ->addIndexColumn()
                    
                    ->editColumn('client_name', function ($request) {
                        return $request->client_name; // human readable format
                    })

                    ->editColumn('property', function ($request) {
                        return $request->title; // human readable format
                    })

                    ->editColumn('date_scheduled', function ($request) {
                        return date('F d Y H:i', strtotime($request->date_scheduled)); // human readable format
                    })
                    

                    //39.087089704070706,-16.202957735676108
                    ->addColumn('action', function($row){
                      //  $btn = '<button  data-toggle="modal" onclick="show_details('.$row->property_id.')" class="edit btn btn-primary btn-sm">View Details</button><button class="btn btn-success btn-sm"><i class="fa fa-edit"> Visit  Location</button>';
                           
                  
                      if(date('Y/m/d', strtotime($row->date_scheduled)) <  date("Y/m/d")) {
                        $btn = '<p style="color: red;">Cannot be removed! Past already on date scheduled!</p>';
                      }else{
                        $btn = '<ul class="demo-btns btn-group-vertical">
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-danger" onclick="remove_apt('.$row->apt_id.')"> <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span> Remove Apnt</a>
                                    </li>
                                </ul>';
                      }

                      
                      return $btn;
                    })

                    ->rawColumns(['action','property_status'])
                    ->make(true);

        }

    }

    public function remove_appointment(Request $request){

        $document = Appointment::find($request->apt_id);

        $document->delete();

        if($document){

            echo "success";

        }else{

            echo "failed";

        }

     }
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
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
