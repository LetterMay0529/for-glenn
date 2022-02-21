<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investigation;
use Illuminate\Support\Facades\Validator;

class Reports extends Controller
{
    public function submit_report(Request $request){

        return view('seekers.report');
    }

    public function create_report(Request $request){

        $validator = Validator::make($request->all(), [ // <---
            'prop_id' => 'required',
            'details'  => 'required',
        ]);

        if($validator->fails()){
        
            /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
            echo json_encode($validator->messages()->getMessages());
    
        }else{

            $res = Investigation::create([
                'customer_id' => auth()->user()->users_id,
                'property_id' => $request->prop_id,
                'details'     => $request->details,
                'status'      => 'new'
            ]);
    
            if($res){
                echo "SUCCESS";
            }else{
                echo "FAILED";
            }

        }

        
    }
}
