<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class CreateAdminCtr extends Controller
{
    public function view_create_admin(){
        
        return view('admin.admin-create-account');

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
                'password'  => ['required', 
                                'min:6', 
                                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
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
                    'rank'       => "2", // "1"=agent; "2"=admin; "0"=seekers;
                    'email'      => $data['email'],
                    'status'     => 'active',
                    'profile_img'=> 'none',
            ]);

            return back()
            ->with('success','Please login to use account.')
            ->with('title', 'Account Successfully created');
            
    }
}
