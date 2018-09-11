<?php

namespace App\Http\Middleware;

use App\Department;
use Closure;
use Illuminate\Support\Facades\Auth;

class DepartAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route()->parameter('did');
        $department = Department::find($id);
//        dd($department);

        if (Auth::user()->admin === 0 &&  $department->admin !== Auth::user()->id) {
            return redirect('home')->with('error', 'Sorry You Dont have permission to enter there');
        }
            return $next($request);
    }
}
