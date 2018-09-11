<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use App\Semester;
use App\Year;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Add New semester
     *
     * @param Request $request
     * @return view
     */
    public function add_semester(Request $request)
    {
//        if($request->isMethod('post')){
        if ($request->ajax()) {
            $year = Year::find($request->year_id);
                $rules =
                    [
                        'name' => 'required|numeric|unique:semester',
                        'start_date' => 'required|date',
                        'end_date' => 'required|date',
                        'status' => 'max:200',
                    ];
                $msg = [
                    'name.required' => 'Name is required',
                    'start_date.date' => 'date is required',
                ];
                $validator = Validator::make($request->all(), $rules, $msg);
                if ($validator->fails()) {
                    return response($validator->errors(), 401);
                }
            }
        if ($year->start_date < $request->start_date) {

        }
           $semester = Semester::create($request->all());


//            return back()->withInput();
        return response($semester);

    }
    public function viewSemester($fid,$did, $pid, $year, $id)
    {
        $this->middleware('DepartAdmin');
        $semester    = semester::where('id', $id)->first();
        $courses = DB::table('course')
            ->join('semester', 'course.semester_id', 'semester.id')
            ->select('semester.name as sem_name','semester.id as sem_id',
                'course.*')
            ->where('semester.id', '=', $id)->get();
        return view('admin.semester.view', [
            'semester'     => $semester,
            'courses'       => $courses,
        ]);
    }

    /**
     * update record of faculty with information of Edit function
     * @param request
     * @return response
     */
    public function update(Request $request)
    {
        if ($request->ajax() || $request->isMethod('post')) {
            $rules =
                [
                    'name' => 'required|numeric',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'status'    => 'string|max:200',
                ];
            $msg = [
                'name.required' => 'Name is required',
                'start_date.date'       => 'date is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }

            $id = $request->input('id');

            $name = $request->input('name');
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $status = $request->input('status');
            $desc = $request->input('en_desc');
            $semester = Semester::find($id);
            $semester->name = $name;
            $semester->start_date = $start_date;
            $semester->end_date = $end_date;
            $semester->status = $status;
            $semester->en_desc = $desc;
            $semester->save();
            return response($semester);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $semester = Semester::find($request->id);
        $semester->delete();
        return 'success';
    }

    /**
     * @param $fid
     * @param $did
     * @param $pid
     * @param $yid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all($fid, $did, $pid, $yid){
        $semesters = Semester::all();
        return view('admin.semester.all', compact('semesters'));
    }
}
