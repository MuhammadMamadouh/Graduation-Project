<?php

namespace App\Http\Controllers;

use App\Course;
use App\Degree;
use App\Department;
use App\Faculty;
use App\Job;
use App\Staff;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $degrees = Degree::all()->count();
        $jobs = Job::all()->count();
        $faculties = Faculty::paginate(10);
        return view('admin.dashboard', [
            'degrees' => $degrees,
            'jobs' => $jobs,
            'faculties' => $faculties,
        ]);
    }


    public function showAdmins()
    {
        $faculties = Faculty::all();
        $admins = Staff::where('admin', '=', 1)->get();

        return view('admin.admins', [
            'admins' => $admins,
            'faculties' => $faculties,
        ]);
    }

    public function add_admin(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->input('admin');
            $staff = Staff::find($id);
            $staff->admin = 1;
            $staff->save();
        }
        return redirect()->back();
    }

    public function remove_admin(Request $request)
    {
        if ($request->ajax()) {

            $staff = Staff::findOrFail($request->id);
            $staff->admin = 0;
            $staff->save();

            return response('success');
        }
    }
}
