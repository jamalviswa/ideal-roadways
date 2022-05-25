<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                        
                if (Auth::user()->role == 'master_admin') {
                    return redirect()->route('master_admin_dashboard');
                }
                if (Auth::user()->role == 'admin') {
                    return redirect()->route('admin-dashboard');
                }
                if (Auth::user()->role == 'driver') {
                    return redirect()->route('driver-dashboard');
                }
                if (Auth::user()->role == 'transport') {
                    return redirect()->route('transport-dashboard');
                }
                // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
