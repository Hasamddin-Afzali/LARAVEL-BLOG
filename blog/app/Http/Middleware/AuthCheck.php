<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('LoggedUser')){
            return redirect('login')->with('fail', 'You Must login'); 
        }
        return $next($request)->header('cache-control', 'no-cache, no-store, max-age=0, must-revalidate')
                            ->header('pragma', 'no-cache')
                            ->header('Expires', 'sat 01 Jan 1990 00:00:00 GMT');
    }
}
