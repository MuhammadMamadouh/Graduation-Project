<?php

namespace App\Http\Controllers;

use App\Contents;
use App\Course;
use App\Course_aims;
use App\Course_narse;
use App\Department;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Program;
use App\Reference;
use App\Semester;
use App\Staff;
use App\Content;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function add(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'code' => 'required|string|max:10',
                    'en_title' => 'required|string|max:255',
                    'weakly_hour' => 'integer|min:3',
                    'students' => 'required|integer'
                ];
            $msg = [
                'code.required' => 'code is required',
                'en_title.required' => 'Title is required',
                'weakly_hour.required' => 'Weakly hours     is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $code = $request->input('code');
            $en_title = $request->input('en_title');
            $weakly_hours = $request->input('weakly_hour');
            $semester = $request->input('semester_id');
            $students = $request->input('students');
            $course = new Course();
            $course->code = $code;
            $course->en_title = $en_title;
            $course->weakly_hour = $weakly_hours;
            $course->semester_id = $semester;
            $course->students = $students;
            $course->save();
//            return $this->viewCourse($course->code);
            return response($course);
        }
    }

    public function all($fid, $did, $pid, $year, $id)
    {
        $courses = DB::table('course')
            ->join('semester', 'course.semester_id', 'semester.id')
            ->select('semester.name as sem_name', 'semester.id as sem_id',
                'course.*')
            ->where('semester.id', '=', $id)->get();
        return view('admin.course.all', [
            'courses' => $courses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'code' => 'required|string|max:10',
                    'en_title' => 'required|string|max:255',
                    'weakly_hour' => 'integer|min:3',
                ];
            $msg = [
                'code.required' => 'code is required',
                'en_title.required' => 'Title is required',
                'weakly_hour.required' => 'Weakly hours is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);

            $validator->SetAttributeNiceNames([
                'code' => 'CODE',
                'en_title' => 'TITLE'
            ]);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $code = $request->input('code');
            $en_title = $request->input('en_title');
            $weakly_hours = $request->input('weakly_hour');
            $course = Course::find($code);
            $course->code = $code;
            $course->en_title = $en_title;
            $course->weakly_hour = $weakly_hours;
            $course->students = $request->students;
            $course->save();
//            return $this->viewCourse($course->code);
            return response($course);
        }
    }

    public function view($fid, $did, $pid, $year, $sid, $code)
    {
        $this->middleware('DepartAdmin');
        $faculties = \App\Faculty::all();
        $all_staff = Staff::all();
        $contents = Course::find($code)->contents()->get();

        $course = Course::find($code);
        $year = Year::find($year);
        $semester = Semester::find($sid);
        $department = Department::find($did);
        $program = Program::find($pid);
        $staff = DB::table('teach')
            ->join('staff', 'teach.staff_id', 'staff.id')
            ->join('academic_degree', 'academic_degree.id', 'staff.academic_degree_id')
            ->select('staff.en_name', 'staff.id',
                'academic_degree.en_degree as degree')
            ->where('teach.course_code', '=', $code)
            ->get();

        return view('admin.course.view', [
            'course' => $course,
            'year' => $year,
            'semester' => $semester,
            'department' => $department,
            'program' => $program,
            'staff' => $staff,
            'staffs' => $all_staff,
            'faculties' => $faculties,
            'contents' => $contents,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $course = Course::find($request->id);
        $course->delete();
        return 'success';
    }


    public function faculties()
    {
        $faculties = \App\Faculty::all();
        return view('admin.course.faculties');
    }

    public function departments($id)
    {
        $departments = \App\Faculty::find($id)->departments;

        return view('admin.course.departments', ['departments' => $departments]);
    }

    public function add_teacher(Request $request)
    {

        if ($request->isMethod('post')) {
            $code = $request->input('course_code');
            $staff = $request->input('staff_id');
            $valid = DB::table('teach')
                ->select('*')
                ->where('course_Code', $code)
                ->where('staff_id', $staff)->get();
            if (count($valid) > 0) {
                return response('This teacher already teaching this course');
            } else {

                DB::table('teach')->insert([
                    'staff_id' => $staff,
                    'course_code' => $code,
                ]);
            }
//            return response('success');
        }
    }

    public function delete_teacher(Request $request)
    {
        if ($request->isMethod('post')) {

            $code = $request->input('course_code');
            $staff = $request->input('staff_id');
            DB::table('teach')
                ->where('staff_id', '=', $staff)
                ->where('course_code', '=', $code)
                ->delete();
//            $request->session()->flash()->success('Successfully Subject Added in Course ' . $code);
            return response($request->all());
//            return redirect()->back();
        }
    }


    public function viewAllStaffs($id)
    {
        $staffs = DB::table('work_at')
            ->join('staff', 'staff.id', 'work_at.staff_id')
            ->select('staff.*')
            ->where('work_at.department_id', '=', $id)
            ->get();
        return view('admin.course.add_teacher.all_staff', ['staffs' => $staffs]);
    }
}