<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->role == '1')  // '1' => 'admin
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('home')->with('status','Access Denied! as you are not as admin');
            }
        }
        else
        {
            return redirect()->route('home')->with('status','Please Login First');
        }
    }
}
