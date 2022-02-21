<?php

namespace App\Http\Controllers;

use App\Models\ReviewAccount;
use Illuminate\Http\Request;

class ReviewAccountCtr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function submitApplication(){

      $review =  ReviewAccount::create([
            'agent_id' => auth()->user()->users_id,
            'status' => 'pending'
        ]);

        if($review){
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
     * @param  \App\Models\ReviewAccount  $reviewAccount
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewAccount $reviewAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReviewAccount  $reviewAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(ReviewAccount $reviewAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReviewAccount  $reviewAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReviewAccount $reviewAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReviewAccount  $reviewAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReviewAccount $reviewAccount)
    {
        //
    }
}
