<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Seeker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {
            if (\Auth::user()->rank == 0) {
                return $next($request);
            }
        }else{
           // echo  "haha";
           return redirect('/login')->with('error',"Please login first!");
        }

        
        
    // if(!empty(auth()->user()->rank)){
    //     if(auth()->user()->rank == 0){
    //          return $next($request);
    //          }
    //      }else{
    //         echo "haha";
    //         return redirect('/login')->with('error',"Please login first!");
    // }
        //echo "haha2";
      //return redirect('/login')->with('warning',"Only admin can access!");
     //echo "Sorry! only Agent can access";
    }
}
