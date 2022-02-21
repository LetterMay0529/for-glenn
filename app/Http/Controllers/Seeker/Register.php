<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class Register extends Controller
{
    public function create_account(){

        return view('seekers.create');
        
    }

    public function sign_up_seeker(Request $request)
    {
         $data = $request->all();

         $validator = Validator::make($request->all(), [ 
                'firstname' => 'required',
                'lastname'  => 'required',
                'middlename'=> 'required',
                'gender'    => 'required',
                'date_of_birth'=>'required',
                'email'     => 'required|email|unique:users',
                'username'  => 'required|unique:users',
                'password'  => 'required|min:6', 
                'phone'     => 'required|unique:users',
            ]);

            if($validator->fails()){
        
                /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
                echo json_encode($validated->messages()->getMessages());
        
            }else{
            
                $result = User::create([
                            'firstname'  => ucwords($data['firstname']),
                            'middlename' => ucwords($data['middlename']),
                            'lastname'   => ucwords($data['lastname']),
                            'gender'     => $data['gender'],
                            'date_of_birth' => date('Y-m-d',strtotime($data['date_of_birth'])),
                            'username'   => $data['username'],
                            'password'   => bcrypt($data['password']),
                            'phone'      => $data['phone'],
                            'rank'       => "0", // "1"=agent; "2"=admin; "0"=seekers;
                            'email'      => $data['email'],
                            'status'     => 'not_verified',
                            'profile_img'=> 'none',
                    ]);
                
                    if($result){
                        echo "SUCCESS";
                    }else{
                        echo "Error: Inserting data to database error!";
                    }

                
            }
            
    }
}
