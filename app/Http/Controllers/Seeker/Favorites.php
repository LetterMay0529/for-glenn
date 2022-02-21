<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;

class Favorites extends Controller
{
    
    public function show_favorite_property(){

        $fav = DB::table('favorite')
                    ->select('property.*','favorite.*')
                    ->join('property', 'property.property_id', '=', 'favorite.property_id')
                    ->where('favorite.customer_id', '=', auth()->user()->users_id)
                    ->orderBy('favorite.created_at', 'desc')
                    ->get(); 

        return view('seekers.favorite',compact(array('fav')));
    }

    public function remove_favorite(Request $request){

        $fav_id = $request->fav_id;

        $result =  DB::table('favorite')->where('fav_id', $fav_id)->delete();

        if($result){
            echo "SUCCESS";
        }else{
            echo "FAILED";
        }

    }
}
