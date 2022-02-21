<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        if(!empty(auth()->user()->rank)){
            if(auth()->user()->rank == 2){
                return $next($request);
            }
        }else{
            return redirect('/admin/login')->with('error',"Please login first!");
        }

      return redirect('/admin/login')->with('error',"Only admin can access!");
    // echo "Sorry! only admin can access";
    }

    
}
