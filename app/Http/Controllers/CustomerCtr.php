<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use DataTables;

class CustomerCtr extends Controller
{
    //
    public function view_customer_list(){
        return view('admin.admin-customer-list');
    }

    public function show_customer_record(Request $request){
        if ($request->ajax()) {
            
            $data = User::select('*')->where('rank', '=', 0)->orderByRaw('CONCAT(lastname, firstname)');

            return Datatables::of($data)
                    
                    ->addIndexColumn()
                    ->setRowId(function ($request) {

                        return 'td_'.$request->users_id;

                    })
                    ->editColumn('profile_img', function ($request) {

                        if($request->profile_img == 'none'){
                            $profile = 'admin_assets/img/avatars/male.png';
                        }else{
                            $profile = 'profile_img/'.$request->profile_img;
                        }

                        return '<img src="'.asset($profile).'" alt=""  style="width: 50px; height: 50px; object-fit: cover;">'; // human readable format

                    })
                    
                    ->editColumn('firstname', function ($request) {

                        return $request->lastname.', '.$request->firstname; // human readable format

                    })
                    
                    ->editColumn('date_of_birth', function ($request) {
                        return date('F d, Y', strtotime($request->date_of_birth));
                     })
                     ->editColumn('email', function ($request) {
                        return $request->email;
                    })
                    ->editColumn('username', function ($request) {
                        return $request->username;
                    })
                    ->editColumn('phone', function ($request) {
                        return $request->phone;
                    })
                    ->editColumn('status', function ($request) {
                        if($request->status == 'active'){
                            $status = '<span class="label label-success">Active</span>';
                        }else if($request->status == 'inactive'){
                            $status = '<span class="label label-danger">Disabled</span>';
                        }else{
                            $status = '<span class="label label-primary">Pending</span>';
                        }
                        return $status;
                    })
                    
                    ->addColumn('action', function($row){
           
                      $btn = '<ul class="demo-btns btn-group-vertical">
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-primary" onclick="saveProperties('.$row->users_id.')"> <span class="btn-label"><i class="glyphicon glyphicon-star"></i></span> Saved Properties </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-default" id="reset_btn_'.$row->users_id.'"onclick="reset_account('.$row->users_id.',\''.$row->firstname.'\', \''.$row->email.'\')"> <span class="btn-label"><i class="fa fa-key"></i></span> Reset </a>
                                    </li> 
                                </ul>';
                      return $btn;
                    })

                    ->rawColumns(['action', 'profile_img', 'status'])
                    ->make(true);
        }
    }

    public function view_properties_table(Request $request){

        $customer_id = $request->customer_id;

        return view('admin.subpages.admin-customer-save-prop', compact('customer_id'));

    }

    public function view_favorite(Request $request){

        //$customer_id = $request->customer_id;
        if ($request->ajax()) {
        $data = DB::table('favorite')
                    ->join('users', 'users.users_id', '=', 'favorite.customer_id')
                    ->join('property', 'property.property_id', '=', 'favorite.property_id')
                    ->select('favorite.fav_id','property.title', 'property.amount', 'property.property_id', 'property.property_size', 'property.prop_img', 'property.property_status')
                    ->where('favorite.customer_id', '=', 5)
                    //-orderBy('favorite.created_at')
                    ->get();

        return Datatables::of($data)
                    
                    ->addIndexColumn()
        
                    ->editColumn('prop_img', function ($request) {

                        
                            $property_img = 'property_img/'.$request->prop_img;
                        
                        return '<img src="'.asset($property_img).'" alt="" width ="100"  >'; // human readable format

                    })
                    
                    ->editColumn('title', function ($request) {

                        return $request->title; // human readable format

                    })
                    
                    ->editColumn('amount', function ($request) {
                        return "₱ ". number_format($request->amount, 2);
                     }) 
                    
                    ->addColumn('action', function($row){
           
                      $btn = '<ul class="demo-btns btn-group-vertical">
                                    <li>
                                        <a href="/seeker/properties/'.$row->property_id.'" class="btn btn-labeled btn-primary">  <span class="btn-label"><i class="glyphicon glyphicon-share"></i></span> Visit Property on website. </a>
                                    </li> 
                            </ul>';
                      return $btn;
                    })

                    ->rawColumns(['action', 'prop_img'])
                    ->make(true);
                }

    }
}
