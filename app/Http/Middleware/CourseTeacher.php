<?php

namespace App\Http\Middleware;

use App\Course;
use App\Department;
use Closure;
use Illuminate\Support\Facades\Auth;

class CourseTeacher
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
        $id = $request->route()->parameter('code');
        $teachers = Course::find($id)->staff;
//        dd($teachers[0]->id);
        foreach ($teachers as $teacher) {
            if (Auth::user()->id !== $teacher->id) {
                return redirect('notAllowed')->with('error', 'Sorry You Dont have permission to enter there');
            }
        }
        return $next($request);
    }
}
