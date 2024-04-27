<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isPetugas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(auth()->user()->role_id == 2){
                return $next($request);
            }
            else{
                return redirect('/dashboard')->with('error', 'Tidak Diberi Akses Menuju Route Tersebut');
            }
        }
        else{
            return redirect('/dashboard');
        }
    }
}
