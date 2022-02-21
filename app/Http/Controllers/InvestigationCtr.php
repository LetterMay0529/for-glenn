<?php

namespace App\Http\Controllers;

use App\Models\Investigation;
use App\Models\AddInvNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use DataTables; 

class InvestigationCtr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function view_new_request_list(Request $request)
    {
        $status = $request->status;

        if($status == 'new' || $status == 'pending' || $status == 'completed' || $status == 'closed'  ){

            return view('admin.admin-investigate-new', compact(array('status')));
            
        }else{ 

            echo "Sorry! You are not allowed to access this data!";

        }

        
    }

    public function view_request_all(Request $request){

        if ($request->ajax()) {

            $status = $request->status;

            $data = DB::table('investigate')
                        ->join('property', 'investigate.property_id', '=', 'property.property_id')
                        ->join('users', 'investigate.customer_id', '=', 'users.users_id') 
                        ->select('investigate.*', 'property.title', 'property.amount', 'property.property_size', 'property.prop_img', 'users.firstname', 'users.lastname')
                        ->where('investigate.status', '=', $status)
                        ->orderBy('investigate.created_at', 'desc')
                        ->get();

        return Datatables::of($data)
                    
                    ->addIndexColumn()
        
                    ->editColumn('prop_img', function ($request) {

                        
                            $property_img = 'property_img/'.$request->prop_img;
                        
                            return '<img src="'.asset($property_img).'" alt="" style="width: 100%; ">'; // human readable format

                    })
                    
                    ->editColumn('title', function ($request) {

                        return '<div class="col-md-8 padding-left-0">
                        <h3 class="margin-top-0"><a href="javascript:void(0);"> '.ucwords($request->title).' </a><br><small class="font-xs"><i>Request to be investigated by <a href="javascript:void(0);">'.$request->firstname.' '.$request->lastname.'</a></i></small></h3>
                        <p> 
                        <strong>Price: </strong>
                        ₱ '.number_format($request->amount, 2).'
                        </p> 
                        <p> 
                        <strong>Size: </strong>
                        '.$request->property_size.' SQM
                        </p> 
                        <p> 
                        <strong>Details: </strong>
                        '.nl2br(e(ucwords($request->details))).'
                        </p> 
                    </div>'; // human readable format

                    })
                    
                    ->editColumn('amount', function ($request) {
                        return "₱ ". number_format($request->amount, 2);
                     }) 
                    
                    ->addColumn('action', function($row){
           
                      $btn = '<ul class="demo-btns btn-group-vertical">
                                    <li>
                                        <a href="/admin/open_request_details/'.$row->inv_id.'" class="btn btn-labeled btn-primary" > <span class="btn-label"><i class="glyphicon glyphicon-share"></i></span> Open Request </a>
                                    </li> 
                            </ul>';
                      return $btn;
                    })

                    ->rawColumns(['action', 'prop_img', 'title'])
                    ->make(true);
        }

    }

    public function open_request_details($inv_id){

        $result = DB::table('investigate') 
                    ->join('property', 'property.property_id', '=', 'investigate.property_id')
                    ->join('users', 'investigate.customer_id', '=', 'users.users_id') 
                    ->select('investigate.*', 'property.title', 'property.amount', 'property.property_size', 'property.prop_img', 'users.firstname', 'users.lastname')
                    ->where('investigate.inv_id', '=', $inv_id)
                    ->orderBy('investigate.created_at', 'DESC')
                    ->get();

        $notes =  DB::table('add_inv_notes')
                    ->join('investigate', 'investigate.inv_id', '=', 'add_inv_notes.inv_id')
                    ->join('users', 'add_inv_notes.reviewed_by', '=', 'users.users_id')
                    ->select('add_inv_notes.*','users.firstname','users.lastname')
                    ->where('add_inv_notes.inv_id', '=', $inv_id)
                    ->orderBy('add_inv_notes.created_at', 'DESC')
                    ->get();

        return view('admin.admin-view-inv-request', compact('result', 'notes', 'inv_id'));

    }

    public function insert_notes(Request $request){
        /* Store data to DB -> property */
        $add_notes =  AddInvNotes::create([

            'inv_id'            => $request->inv_id,
            'reviewed_by'       => auth()->user()->users_id,
            'notes_details'     => $request->notes_details,
            'status'            => $request->status

        ]);

        if($add_notes){

            $investigate = Investigation::find($request->inv_id);
            $investigate->status = $request->status;
            $investigate->save();

            if($investigate){
                echo "SUCCESS";
            }else{
                echo "FAILED";
            }

        }else{
            echo "FAILED";
        }
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
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function show(Investigation $investigation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function edit(Investigation $investigation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investigation $investigation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investigation $investigation)
    {
        //
    }
}
