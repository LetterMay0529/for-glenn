<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
//use Illuminate\Foundation\Auth\ThrottlesLogins;
 

class LoginController extends Controller
{
    //

    //protected $maxAttempts = 3;
    //protected $decayMinutes = 2;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $user = \Auth::user();
        // echo json_encode($user);
        
    }

    public function login_form()
    {
        //
        return view('admin.login');
    }

    public function create_user()
    {
        return view('admin.create');
    }

    public function login(Request $request)
    {  
        $inputVal = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(auth()->attempt(array('email' => $inputVal['email'], 'password' => $inputVal['password']))){
            
            if (auth()->user()->rank == 1) {

               return redirect()->route('admin.agent')->with('title', 'Login Success')->with('success','You have successfully sign in to agent dashboard');
    
            }else if (auth()->user()->rank == 2) {
    
                return redirect()->route('admin.home')->with('title', 'Login Success')->with('success','You have successfully sign in to admin dashboard');
    
            }else{
    
             return redirect()->route('home');

            }    

        }else{
            
            return redirect()->route('admin.loginshow')->with('error','Email & Password are incorrect.')->withInput();
            
        }
    }
    
    #======== START GENERAL ADMIN CREATED FUNCTIONS ==================
    
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('seeker.login');
    }
    

}
