<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Broker;
use App\Models\Documents;
use App\Models\ReviewAccount;

class ProfileCtr extends Controller
{
    //

    public function agent_profile()
    {
        //echo "admin agent";
        $result = Broker::select('*')
                        ->where('agent_id', '=', auth()->user()->users_id)
                        ->get();

        $num = count($result); 

        $document = Documents::select('*')
                        ->where('agent_id', '=', auth()->user()->users_id)
                        ->get();
        
        $document_select = array(
            'Passport',
            'SSS ID or SSS Umid Card',
            'GSIS ID or GSIS Umid Card',
            'Driver License',
            'PRC ID',
            'Philhealth ID',
            'Pagibig ID',
            'Philsys ID'
        );

        foreach($document as $value){

            if (in_array($value['document_name'], $document_select))
            {
                if (($key = array_search($value['document_name'], $document_select)) !== false) {
                    unset($document_select[$key]);
                }
            }

        }

        $review = ReviewAccount::select('*')
                        ->where('agent_id', '=', auth()->user()->users_id)
                        ->orderBy('created_at','ASC')
                        ->get();
        

        //echo json_encode($document_select);

        

    return view('admin.client.agent-profile', compact('result','num', 'document', 'document_select', 'review'));

    }

    public function update_user_details(Request $request){
        
        $attr   = $request->name;
        $val    = $request->value;

        if($request->name == 'email'|| $request->name == 'username'){

            if($request->name == 'email'){

                $validator = Validator::make($request->all(),
                    ['value' => 'required|email'],
                    ['value.email' => 'Please provide a correct email!']
                );

                if($validator->fails()){

                   echo json_encode($validator->messages()->getMessages());
                   http_response_code(500);
                    die();

                }
            }

            if($request->name == 'username'){

                $validator = Validator::make($request->all(),array(
                    'value' => 'required|min:3'
                )
                );

                if($validator->fails()){

                   echo json_encode($validator->messages()->getMessages());
                   http_response_code(500);
                    die();

                }
            }

            $result = User::select('users_id')->where( $attr , $request->value )

                        ->get();

            if(count($result) > 0){
                http_response_code(500);
                die(ucwords($request->name).' already exist!');

            }

        }

        $user          = User::find(auth()->user()->users_id);
        $user->$attr   = $request->value;
        $user->save();

        if($user){

            echo "success";

        }else{

            echo "failed";

        }
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

    public function admin_profile_settings(){

        return view('admin.admin-profile-setting');
        
    }

    public function change_password(Request $request){

        $rules = array(  
            'password'         => ['required', 
                                    'min:6', 
                                    'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
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
