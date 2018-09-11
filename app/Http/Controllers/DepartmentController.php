<?php

namespace App\Http\Controllers;

use App\Department;
use App\Faculty;
use App\Job;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;


class DepartmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * add department by ajax
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function add_department(Request $request)
    {
        if ($request->ajax()) {
//if($request->isMethod('post')){
            $rules =
                [
                    'en_name' => 'required|string|unique:department|max:255',
                ];
            $msg = [
                'en_name.required' => 'Name is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $department = Department::create($request->all());
            return response($department);
        }
    }

    /**
     * view Department page
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function viewDepartment($fid, $id)
    {
        $this->middleware('DepartAdmin');

        $department = Department::find($id);
        $programs = Program::where('department_id', $id)->get();

        return view('admin.department.view', [
            'department' => $department,
            'programs' => $programs,
        ]);
    }

    // used in ajax methods, add teacher or add admin .. etc, to view all departments in specific faculty
    public function viewAllDepartments($id)
    {
        $departments = Department::where('faculty_id', $id)->get();
//        $departments = Faculty::find($id)->departments();

        return view('admin.course.add_teacher.all_departments', ['departments' => $departments]);
    }

    public function all($id)
    {
        $departments = Department::where('faculty_id', $id)->get();
        $faculty = Faculty::find($id);
        return view('admin.department.all', [
            'departments' => $departments,
            'faculty' => $faculty,
        ]);
    }
    /**
     * Delete department
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request)
    {
        Department::destroy($request->id);
        return response(['message' => 'department deleted successfully']);
    }

    /**
     * Edit Coordinators of department
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_coordinators($fid,$did)
    {
        $this->middleware('DepartAdmin');
//        $coo =Department::find($did)->coordinators($did)->paginate(10);
        $coo =  DB::table('work_at')
            ->join('staff', 'work_at.staff_id', 'staff.id')
            ->join('job', 'work_at.job_id', 'job.id')
            ->join('academic_degree', 'staff.academic_degree_id', 'academic_degree.id')
            ->select('staff.en_name', 'staff.mobile', 'staff.email', 'staff.id', 'academic_degree.en_degree as degree',
                'academic_degree.id as degree_id', 'job.en_title as job', 'work_at.start_date')
            ->where('work_at.department_id', $did)
            ->where('work_at.job_id', '1')
            ->orWhere('work_at.job_id', '2')->paginate(10);
        return view('admin.department.coordinators', [
            'coordinators' => $coo,
        ]);
    }



    public function department_staff($fid, $did)
    {
        $this->middleware('DepartAdmin');
        $department = Department::find($did);
        // for add staff blade
        $ac_degrees = DB::table('academic_degree')->select('*')->get();
        $jobs = Job::all();

        // for view page

        $all_staff = Department::find($did)->staff()->paginate(10);
        $admin = Department::find($did)->admin();
        return view('admin.staff.department_staff', [
            'all_staffs' => $all_staff,
            'department' => $department,
            'ac_degrees' => $ac_degrees,
            'jobs' => $jobs,
            'admin' => $admin,
        ]);
    }

    public function add_admin(Request $request)
    {
        if ($request->isMethod('post')) {

            $id = $request->input('department');
            $department = Department::find($id);
            $department->admin = $request->admin;
            $department->save();

//            return response($request->all());
            return redirect()->back();
        }
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
