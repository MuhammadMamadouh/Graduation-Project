<?php

namespace App\Http\Middleware;

use App\Department;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!(Auth::user()->admin === 1))
            return redirect('profile')->with('error', 'Sorry You Dont have permission to enter there');

        return $next($request);
    }
}
