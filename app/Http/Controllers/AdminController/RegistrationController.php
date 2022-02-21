<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class RegistrationController extends Controller
{
    //
    public function __construct(){

    }

    public function sign_up_admin(Request $request)
    {
         $data = $request->all();

           $validated = $request->validate([
                'firstname' => 'required',
                'lastname'  => 'required',
                'middlename'=> 'required',
                'gender'    => 'required',
                'date_of_birth'=>'required',
                'email'     => 'required|email|unique:users',
                'password'  => 'required|min:6',
                'passwordConfirm' => 'required|same:password',
                'phone'     => 'required|unique:users',
            ]);

           // echo json_encode($data);
            
            User::create([
                    'firstname'  =>ucwords($data['firstname']),
                    'middlename' => ucwords($data['middlename']),
                    'lastname'   => ucwords($data['lastname'])." ".ucwords($data['suffix']),
                    'gender'     => $data['gender'],
                    'date_of_birth' => date('Y-m-d',strtotime($data['date_of_birth'])),
                    'username'   => $data['username'],
                    'password'   => bcrypt($data['password']),
                    'phone'      => $data['phone'],
                    'rank'       => "1", // "1"=agent; "2"=admin; "0"=seekers;
                    'email'      => $data['email'],
                    'status'     => 'not_verified',
                    'profile_img'=> 'none',
            ]);

            return back()
            ->with('success','Please login to use account.')
            ->with('title', 'Account Successfully created');
            
    }
}
