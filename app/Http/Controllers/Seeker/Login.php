<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function login(){

        return view('seekers.login');
        
    }
    public function login_seeker(Request $request)
    {  
        $inputVal = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $inputVal['email'], 'password' => $inputVal['password']))){
            
            if (auth()->user()->rank == 0) {

                echo "SEEKER_LOGIN";
     
             }else if (auth()->user()->rank == 1) {
     
                 //return redirect()->route('admin.home')->with('title', 'Login Success')->with('success','You have successfully sign in to admin dashboard');
                 echo "AGENT_LOGIN";
     
             } 

        }else{
            
             echo "ERROR";
            
        }
        
        
        
    }
    
    #======== START GENERAL ADMIN CREATED FUNCTIONS ==================
    
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('seeker.login')->with('warning','Please login first!');
        
    }
}
