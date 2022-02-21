<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\Broker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrokerCtr extends Controller
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

    //========= USER DEFINED FUNCTION ===================
    public function create_broker(Request $request){

        $data = $request->all();

        $validator = Validator::make($request->all(), [ // <--- 
            'broker_name'   => 'required',
            'broker_details' => 'required', 
            'broker_img_license'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
        
            /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
            echo json_encode($validator->messages()->getMessages());
    
        }else{

            $brokerImg = time().'.'.$request->broker_img_license->getClientOriginalExtension() ; //$request->image->extension();  

            $request->broker_img_license->move(public_path('broker_img'), $brokerImg);

            $broker =  Broker::create([ 
                'agent_id'              => auth()->user()->users_id,
                'broker_name'           => ucwords($data['broker_name']),
                'broker_details'        => $data['broker_details'],
                'broker_img_license'    => $brokerImg,
                'status'                => 'verified'
            ]);

            if($broker){

                //echo 'Information added to database!';
                echo 'SUCCESS';

            }else{

                //Error when failed..
                echo 'Saving to database error. Please try again!';

            }
        }

    }

    public function update_broker_details(Request $request){

        $attr   = $request->name;
        $val    = $request->value;

        $broker          = Broker::find($request->broker_id);
        $broker->$attr   = $request->value;
        $broker->save();

        if($broker){

            echo "success";

        }else{

            echo "failed";
            http_response_code(500);

        }
    }

    public function update_broker_img(Request $request){

        $id = $request->broker_id; 

        $validator = Validator::make($request->all(), [ // <--- 
            'broker_license_update_img'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        if($validator->fails()){
        
            /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
            echo json_encode($validator->messages()->getMessages());
    
        }else{

            $brokerImg = time().'.'.$request->broker_license_update_img->getClientOriginalExtension() ; //$request->image->extension();  

            $request->broker_license_update_img->move(public_path('broker_img'), $brokerImg);


            $broker                         = Broker::find($request->broker_id);
            $broker->broker_img_license     = $brokerImg;
            $broker->save();

            if($broker){

                //echo 'Information added to database!';
                echo 'SUCCESS';

            }else{

                //Error when failed..
                echo 'Saving to database error. Please try again!';

            }
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
     * @param  \App\Models\Broker  $broker
     * @return \Illuminate\Http\Response
     */
    public function show(Broker $broker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Broker  $broker
     * @return \Illuminate\Http\Response
     */
    public function edit(Broker $broker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Broker  $broker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Broker $broker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Broker  $broker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Broker $broker)
    {
        //
    }
}
