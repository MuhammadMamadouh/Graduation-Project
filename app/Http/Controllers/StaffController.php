<?php

namespace App\Http\Controllers;

use App\Department;
use App\Job;
use Illuminate\Http\Request;
use App\Staff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{

    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function view($id)
    {
        $staff = Staff::find($id)->view();
        // for update staff page
        $ac_degrees = DB::table('academic_degree')->get();
        $jobs = Job::all();
        $courses = Staff::find($id)->courses;
        return view('admin.staff.view', [
            'staff' => $staff,
            'courses' => $courses,
            'ac_degrees' => $ac_degrees,
            'jobs' => $jobs,
        ]);
    }



    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules =
                [
                    'en_name' => 'required|min:3|max:225|unique:staff',
                    'mobile' => 'required|numeric',
                    'email' => 'required|string|email|max:255|unique:staff',
                    'password' => 'required|confirmed|min:3|max:225',
                ];
            $msg = [
                'en_name.required' => 'Content is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
        }
        $staff = Staff::create([
            'en_name' => $request->en_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mobile' => $request->mobile,
            'academic_degree_id' => $request->academic_degree_id,
        ]);    //create staff


        $job = $request->input('job');
        $staff_id = $staff->id;
        $department = $request->input('department');
        $now = DB::raw('NOW()');

        /**
         * insert staff into department by "work_at" table
         */
        DB::table('work_at')->insert(array(
            'staff_id' => $staff_id,
            'department_id' => $department,
            'start_date' => $now,
            'job_id' => $job,
        ));
        return response($staff);

    }

    public function edit(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules =
                [
                    'en_name' => 'required|min:3|max:225',
                    'mobile' => 'required|numeric',
                    'email' => 'required|string|email|max:255',
                ];
            $msg = [
                'en_name.required' => 'Content is required',
            ];

            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
        }

        $staff = Staff::find($request->id);
        $staff->en_name = $request->en_name;
        $staff->email = $request->email;
        $staff->mobile = $request->mobile;
        $staff->academic_degree_id = $request->academic_degree_id;
        $staff->save();

        $job = $request->input('job');
        $staff_id = $staff->id;
        $department = $request->input('department');
        $now = DB::raw('NOW()');

        /**
         * insert staff into department by "work_at" table
         */
        DB::table('work_at')
            ->where('staff_id', $staff_id)
            ->where('department_id', $department)
            ->update([
                'start_date' => $now,
                'job_id' => $job,
            ]);
        return response($request->all());

    }

    /**
     * Delete Staff
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request)
    {
        Staff::destroy($request->id);
        return response(['message' => 'Staff deleted successfully']);
    }
}
