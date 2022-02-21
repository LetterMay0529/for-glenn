<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User; 

class DocumentCtr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function add_documents(Request $request){

        $rules = array(
            'id_type'=> 'required', 
            'document_desc'=> 'required',
            'documentImg'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
 
        if($request->id_type == 'Other') {
            $rules = array(
                'id_type'=> 'required',
                'specify_type_of_id'=> 'required',
                'document_desc'=> 'required',
                'documentImg'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            );
        }

        $validator = Validator::make($request->all(),  $rules);

        if($validator->fails()){
        
            /* === DISPLAY THE ERROR MESSAGES DURING VALIDATION === */
            echo json_encode($validator->messages()->getMessages());
    
        }else{

            $documentImg = time().'.'.$request->documentImg->getClientOriginalExtension() ; //$request->image->extension();  

            $request->documentImg->move(public_path('document_img'), $documentImg);

            $doc_name = $request->id_type;
            if($request->id_type == 'Other') {
                $doc_name = $request->specify_type_of_id;
            }

            $document =  Documents::create([
                'agent_id'          => auth()->user()->users_id,
                'document_name'     => $doc_name,
                'description'       => $request['document_desc'],
                'document_img'      => $documentImg, 
            ]);

            if($document){

                //echo 'Information added to database!';
                echo 'SUCCESS';

            }else{

                //Error when failed..
                echo 'Saving to database error. Please try again!'; 

            }
        }
     }

     public function remove_document(Request $request){

        $document = Documents::find($request->document_id);

        $document->delete();

        if($document){

            echo "success";

        }else{

            echo "failed";

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
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function show(Documents $documents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function edit(Documents $documents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documents $documents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documents $documents)
    {
        //
    }
}
