<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Read_Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DataTables;

class AnnouncementCtr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_announcement(){
        return view('admin.admin-create-announcement');
    }

    public function publish_announcement(Request $request){
 

        $validator = Validator::make($request->all(), [ // <---
            'subject'         => 'required',
            'content'         => 'required'
        ]);
    
        if($validator->fails()){
        
            /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
            echo json_encode($validator->messages()->getMessages());

        }else{

            $announcement =  Announcement::create([
                'subject'          => ucwords($request['subject']),
                'content'          => $request['content'],
                'intended_to'      => $request['intended_to'],
                'published_by'     => auth()->user()->users_id
            ]);

            if($announcement){

                //echo 'Information added to database!';
                echo 'SUCCESS';

            }else{

                echo 'Saving to database error. Please try again!';

            }

        }

    }
    public function view_announcement_list(){
        return view('admin.admin-view-prev-announcement');
    }

    public function announcement_list(Request $request){

        if ($request->ajax()) {
 
            $data = DB::table('announcement')
                    ->join('users', 'users.users_id', '=', 'announcement.published_by')
                    ->select('announcement.*','users.firstname', 'users.lastname')
                    ->orderBy('announcement.created_at', 'DESC')
                    ->get();

            return Datatables::of($data)
                    
                    ->addIndexColumn()
               
                    
                    ->editColumn('created_at', function ($request) {
                        return date("jS F, Y h:i A", strtotime($request->created_at));//date_format('M d, Y h:i A', strtotime($request->created_at));
                    })
                    
                    ->editColumn('subject', function ($request) {
                        return $this->trim_data($request, 'subject', 50); 
                     })
                    ->editColumn('content', function ($request) {
                       return $this->trim_data($request, 'content', 100); 
                    })

                    ->editColumn('intended_to', function ($request) {
                        return $request->intended_to; 
                     })
                    ->editColumn('published_by', function ($request) {
                        return ucwords($request->firstname).' '.ucwords($request->lastname); 
                     })
                    //39.087089704070706,-16.202957735676108
                    ->addColumn('action', function($row){
                      //  $btn = '<button  data-toggle="modal" onclick="show_details('.$row->property_id.')" class="edit btn btn-primary btn-sm">View Details</button><button class="btn btn-success btn-sm"><i class="fa fa-edit"> Visit  Location</button>';
                           
                      $btn = '<ul class="demo-btns btn-group-vertical">
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-primary" onclick="viewAnnouncement('.$row->announcement_id.')" > <span class="btn-label"><i class="fa fa-eye"></i></span>View</a>
                                    </li>
                                   
                                </ul>';

                            //     <li>
                            //     <a href="javascript:void(0);" class="btn btn-labeled btn-danger" onclick="removeAnnouncement('.$row->announcement_id.')" > <span class="btn-label"><i class="fa fa-trash"></i></span>Delete</a>
                            // </li>
                      return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);

        }
    }

    public function trim_data($request, $attr, $val){

        if (strlen($request->$attr) > $val) {

            $stringCut = substr($request->$attr, 0, $val);
            $endPoint = strrpos($stringCut, ' ');
        
            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            return $string .= '...';
            
        }else{
            return $request->$attr; //$request->date_end->format('Y-m-d'); // human readable format
        }
    }

    public function removeAnnouncement(Request $request){

        $res = DB::table('announcement')->where('announcement_id', $request->announcement_id)->delete();

        if($res){

            echo "SUCCESS";

        }else{

            echo "Execution failed: Problem in executing data in DB!";

        }
    }

    public function show_announcement_by_id(Request $request){

        $data = DB::table('announcement')
                    ->join('users', 'users.users_id', '=', 'announcement.published_by')
                    ->select('announcement.*','users.firstname', 'users.lastname')
                    ->where('announcement.announcement_id', '=', $request->announcement_id)
                    ->get();

        if(count($data) > 0){
            echo "<div>
                        <div class='row'>
                            <div class='col col-md-6'>
                                <p>Created on <i class='fa fa-calendar'></i> ".date("F d, Y", strtotime($data[0]->created_at))."</p>
                            </div>
                            <div class='col col-md-6'>
                                <p>Created by: ".$data[0]->firstname.' '.$data[0]->lastname."</p>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col col-md-12'>
                                <h2>Subject: ".$data[0]->subject."</h2>
                                <p>".nl2br(e($data[0]->content))."</p>
                            </div>
                        </div>
                </div>";
        }else{
            echo "<center><p>No content.</p></center>";
        }
        
    }

    public function agent_view_notification(Request $request){
        
        $new_data = [];
         $data = DB::table('announcement')
                    ->join('users', 'users.users_id', '=', 'announcement.published_by')
                    ->select('announcement.*','users.firstname', 'users.lastname')
                    ->where('announcement.intended_to', '=', 'agent_customer_only')
                    ->orWhere('announcement.intended_to', '=', 'agent_only')
                    ->limit(10)
                    ->get();

        foreach($data as $list){

            $res = DB::table('read_announcement') 
                    ->select('read_id')
                    ->where('announcement_id', '=', $list->announcement_id)
                    ->where('reader_id', '=', auth()->user()->users_id)
                    ->get();
            
            $status = '';

            if(count($res) == 0){
                $status = 'unread';
            }

            $new_data[] = array(
                'announcement_id' => $list->announcement_id,
                'fullname' =>$list->firstname.' '.$list->firstname,
                'subject' => $list->subject,
                'content' => $list->content,
                'status'  => $status,
                'created' => $list->created_at
            );
        }
 
       return view('admin.client.modal.notification-page', compact(array('new_data')));

    }

    public function view_announcement_details($ann_id){
        //echo $ann_id;

        $read = Read_Announcement::where('announcement_id', '=', $ann_id )->first();
        if ($read === null) {

           $reader = Read_Announcement::create([
                'announcement_id' => $ann_id,
                'status' => 'read',
                'reader_id' => auth()->user()->users_id
            ]);

        }

        $data = Announcement::select('*')
                    ->where('announcement_id', '=', $ann_id)
                    ->get();
                     
        if(count($data) > 0){
            return view('admin.client.agent-view-announcement-details', compact(array('data')));
        }else{
            $completed = 'false';
            return view('admin.error404', compact(array('completed'))); 
        }
        

    }

    public function index()
    {
        //
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
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
