<?php

namespace App\Http\Controllers;

use App\Models\PropertyMdl;
use App\Models\Add_Property_Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 'JJ';
    }

    public function add_images(Request $request){

        $request->prop_id;
        $data = PropertyMdl::select('*')
                            ->where('property_id', '=', $request->prop_id)
                            ->get();

        return view('admin.client.modal.add_images_property',compact(array('request','data')));
        
    }

    public function upload_image_property(Request $request){

 
        $imageName = time().'.'.$request->file('file')->getClientOriginalExtension();

        $request->file('file')->move(public_path('property_img'), $imageName);
        
        $result = Add_Property_Photo::create([
            'property_id' => $request->property_id,
            'image_name'  => $imageName 
        ]);

        if($result){
            echo 'success';
        }else{
            echo 'failed!';
        }

    }

    public function fetch_existing_img(Request $request){

        $fileList = Add_Property_Photo::select('*')
                            ->where('property_id', '=', $request->property_id)
                            ->get();

        $data = array();

        foreach($fileList as $result){
 
            $size = \File::size(public_path('property_img/'.$result['image_name']));

            $data[] = array(
                'name' =>   $result['image_name'],
                'size' =>  $size
            );

        }

    echo json_encode($data);
    
    }

    public function delete_property_photo(Request $request){   

        $filename =  $request->get('filename');//gives orginal file name eg:abc.jpg
        Add_Property_Photo::where('image_name',$filename)->delete();
        return "ok";

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
     * @param  \App\Models\PropertyMdl  $propertyMdl
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyMdl $propertyMdl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyMdl  $propertyMdl
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyMdl $propertyMdl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyMdl  $propertyMdl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyMdl $propertyMdl)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyMdl  $propertyMdl
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyMdl $propertyMdl)
    {
        //
    }
}
