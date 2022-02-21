<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ProfileCtr extends Controller
{
    public function user_profile(){
        return view('seekers.profile');
    }

    public function update_profile_img(Request $request){
 

        $validator = Validator::make($request->all(), [ // <--- 
            'profilePhoto'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        if($validator->fails()){
        
            /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
            echo json_encode($validator->messages()->getMessages());
    
        }else{

            $profileImg = time().'.'.$request->profilePhoto->getClientOriginalExtension() ; //$request->image->extension();  

            $request->profilePhoto->move(public_path('profile_img'), $profileImg);


            $user                  = User::find(auth()->user()->users_id);
            $user->profile_img     = $profileImg;
            $user->save();

            if($user){

                //echo 'Information added to database!';
                echo 'SUCCESS';

            }else{

                //Error when failed..
                echo 'Saving to database error. Please try again!';

            }
        }

    }

    public function update_seekers_profile(Request $request){

        $data_to_validate = array(
                'firstname' => 'required',
                'lastname'  => 'required', 
                'gender'    => 'required',
                'date_of_birth'=>'required', 
                'password'  => 'required|min:6',
                'passwordConfirm' => 'required|same:password',
                'phone'     => 'required|unique:users', 
        );

        array_push($data_to_validate, 'email' );

        echo json_encode($data_to_validate);

        // $validated = $request->validate();


        // $user  = User::find(auth()->user()->user_id);
        // $user->firstname        = $request->firstname;
        // $user->lastname         = $request->lastname;
        // $user->username         = $request->username;
        // $user->gender           = $request->gender;
        // $user->date_of_birth    = $request->date_of_birth;

        // $user->save();
    }

    public function update_user_information(Request $request){

            $users_data = array(
                'firstname' => 'required',
                'lastname'  => 'required', 
                'gender'    => 'required',
                'date_of_birth'=>'required',  
            );

            $validator = Validator::make($request->all(), $users_data);

            if($validator->fails()){
        
                /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
                echo json_encode($validator->messages()->getMessages());
        
            }else{

                $users = User::find(auth()->user()->users_id);
                $users->firstname       = $request->firstname;
                $users->lastname        = $request->lastname;
                $users->gender          = $request->gender;
                $users->date_of_birth   = $request->date_of_birth;
                $users->save();

                if($users){

                    echo "SUCCESS";

                }else{

                    echo "ERROR : FAILED TO UPDATE!";
                    
                }

            }

    }

    
    public function update_email(Request $request){

            $users_data = array( 
                'email'     => 'required|email|unique:users'
            );
            $validator = Validator::make($request->all(), $users_data);

            if($validator->fails()){
        
                /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
                echo json_encode($validator->messages()->getMessages());
        
            }else{

                $users = User::find(auth()->user()->users_id);
                $users->email = $request->email;
                $users->save();

                if($users){

                    echo "SUCCESS";

                }else{

                    echo "ERROR : FAILED TO UPDATE!";
                    
                }

            }

    }

    public function update_username(Request $request){

        $users_data = array( 
            'username'     => 'required|unique:users'
        );
        $validator = Validator::make($request->all(), $users_data);

        if($validator->fails()){
    
            /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
            echo json_encode($validator->messages()->getMessages());
    
        }else{

            $users = User::find(auth()->user()->users_id);
            $users->username = $request->username;
            $users->save();

            if($users){

                echo "SUCCESS";

            }else{

                echo "ERROR : FAILED TO UPDATE!";
                
            }

        }

}

    public function change_password(Request $request){

        $rules = array(  
            'password'         => ['required','min:6'],
            'passwordConfirm' => 'required|same:password'// required and has to match the password field
        );
        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);
    
        // check if the validator failed -----------------------
        if ($validator->fails()) {
     
            /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
            echo json_encode($validator->messages()->getMessages());
    
        }else{

            $change = User::find(auth()->user()->users_id);
            $change->password = bcrypt($request->password);
            $change->save();

            if($change){

                echo "SUCCESS";

            }else{

                echo "Error on updating password. Please try again!";
                
            }

        }
    } 
}
