<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class Driver
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == 'master_admin') {
            return redirect()->route('master_admin_dashboard');
        }
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin-dashboard');
        }
     
        if (Auth::user()->role == 'transport') {
            return redirect()->route('transport-dashboard');
        }
           if (Auth::user()->role == 'truck') {
            return redirect()->route('truck-dashboard');
        }
        return $next($request);
    }
}
