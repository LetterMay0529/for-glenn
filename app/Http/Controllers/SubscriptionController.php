<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

    }

    public function view_subscription()
    {

        $result = $this->verify_agent_have_subscription();
        $prev_sub = $this->verify_agent_prev_subscription();
        return view('admin.client.agent-subscription')->with(array('result'=>$result, 'prev' => $prev_sub));
        
        
    }

    private function verify_agent_have_subscription(){

        $data = Subscription::select('*')->where('users_id', auth()->user()->users_id) 
                                         ->where('status', '!=', 'cancelled')
                                         ->limit(1)
                                         ->get();
        return $data;
    }

    private function verify_agent_prev_subscription(){

        $data = Subscription::select('*')->where('users_id', auth()->user()->users_id) 
                                         ->get();
        return $data;
    }

    public function add_agent_subscription(Request $request)
    {
        $result = $this->verify_agent_have_subscription();

        if($result->isEmpty()){

            $data = $request->all();

            $result = Subscription::create([

                'users_id'          => auth()->user()->users_id,
                'paypal_sub_id'     => $data['paypal_sub_id'],
                'paypal_order_id'   => $data['paypal_order_id'],
                'plan_subs'         => 'monthly', 
                'status'            => 'active',
                'date_started'      => date('Y-m-d H:i:s'),
                'date_ended'        => date('Y-m-d', strtotime('+1 month')),
                'auto_renew'        => 'off'

            ]);

            if($result){
                echo "success";
            }else{
                echo "failed: Query error!";
            }

        }else{

            echo "Failed: Agent has a subscription before! You may activate the subscription by going to.";

        }

    }

    public function update_subscription_status(Request $request){

        $subscription  = Subscription::find($request->subscription_id);
        $subscription->status =  $request->status;
        $subscription->save();

        if($subscription){
                
            echo 'success';

        }else{

            echo 'failed';

        }
    }


    public function load_subscription_data(){

        return view('admin.client.modal.view_subscription_details');

    }

    public function update_agent_subscription_status(Request $request){

        $accessToken = $this->get_access_token();

        $url = "https://api-m.sandbox.paypal.com/v1/billing/subscriptions/".$request->paypal_sub_id."/".$request->command;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Content-Type: application/json",
        "Authorization: Bearer ".$accessToken,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = <<<DATA
        {

        "reason": "Customer-requested pause"

        }
        DATA;

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        var_dump($resp);


        $status = '';
        if($request->command == 'suspend') {
            $status = 'paused';
        }
        if($request->command == 'cancel') {
            $status = 'cancelled';
        } 
        if($request->command == 'activate') {
            $status = 'active';
        }

        $subscription  = Subscription::find($request->subscription_id);
        $subscription->status =  $status;
        $subscription->save();

    }


    public function get_access_token(){
        
            $url = "https://api-m.sandbox.paypal.com/v1/oauth2/token";

            $curl =  curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSLVERSION , 6);

            $headers = array(
            "Accept: application/json",
            "Accept-Language: en_US",
            "Content-Type: application/x-www-form-urlencoded",
            "Authorization: Basic QWJrLXFRUGNjZkJxYVhSUHU0WWJyVEhaUmRXeDNfb1ZwM3hOTDVPWkNaOWtMUW5BU2t0a0hSb0FkVWVPSDlmZUtKWnhIS19iOEpXLWJNLW46RU9FR2llelc1bWE4a3p0dHRUeFV5b0FrZDU3cXROZ1JLOGJVU2lmVE5YcndjNWZpOVUta0swVGNGMk40Ui1JNTZQSklKZnZoMVpDZ2E5ZEQ=",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = "grant_type=client_credentials";

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);

            if(empty($resp))die("Error: No response.");
            else
            {
                $json = json_decode($resp);
                return $json->access_token;
            }
            curl_close($curl);
            //var_dump($resp);
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
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
