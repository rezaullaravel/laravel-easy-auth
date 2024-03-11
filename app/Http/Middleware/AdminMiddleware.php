<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check()){
            if(Auth::user()->role=='1'){//1 for admin, 0 for user
                return $next($request);
            }else{
                return redirect()->route('user.dashboard');
            }
        }else{
            return redirect('/login');
        }
    }
}
