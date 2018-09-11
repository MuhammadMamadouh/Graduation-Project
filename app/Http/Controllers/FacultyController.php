<?php

namespace App\Http\Controllers;

use App\Department;
use App\Faculty;
use App\Faculty_aims;
use App\Grades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class FacultyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function all()
    {
        $faculties   = Faculty::paginate(10);
        return view('admin.faculty.all', [
            'faculties' => $faculties,
        ]);
    }
    /**
     * add faculty by ajax
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request)
    {

        if ($request->ajax()) {
            $rules =
                [
                    'en_name' => 'required|string|unique:faculty|max:255',
                    'fax' => 'required|numeric|min:5',
                    'telephone' => 'required|numeric|min:5',
                ];
            $msg = [
                'telephone.required' => 'telephone is required',
                'fax.required' => 'fax is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $faculty = Faculty::create($request->all());
            return response($faculty);
        }
    }

    /**
     * view faculty, its departments and its aims
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($id)
    {
        $faculties = Faculty::all();
        $faculty = Faculty::find($id);
        $departments = Department::where('faculty_id', $id)->get();
        return view('admin.faculty.view', [
            'faculty' => $faculty,
            'departments' => $departments,
            'faculties' => $faculties,
        ]);
    }

    /**
     * Delete Faculty
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request)
    {
        Faculty::destroy($request->id);
        return response(['message' => 'faculty deleted successfully']);
    }

    /**
     * Edit faculty return information to ajax request
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax() || $request->isMethod('get')) {
            $faculty = Faculty::find($id);
            return response()->json($faculty);
        }
    }

    /**
     * update record of faculty with information of Edit function
     * @param request
     * @return response
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'en_name' => 'required|string|max:255',
                    'fax' => 'required|numeric|min:5',
                    'telephone' => 'required|numeric|min:5',
                ];
            $msg = [
                'telephone.required' => 'telephone is required',
                'fax.required' => 'fax is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $faculty = Faculty::find($request->id);
            DB::table('faculty')
                ->where('id', $request->id)
                ->update(array(
                    'en_name' => $request->en_name,
                    'fax' => $request->fax,
                    'telephone' => $request->telephone,
                ));
            return response($request->all());
        }
    }

    //    -------------------- Aims -----------------

    /**
     * View aims of faculty
     * @param $id
     * @return View
     */
    public function view_aims($id)
    {
        $aims = Faculty::find($id)->aims()->get();

        return view('admin.faculty.aims.view', [
            'aims' => $aims,
            'faculty_id' => $id,
        ]);
    }

    /**
     * Add Aims to Faculty
     * @param Request $request
     * @return Response
     */
    public function add_aims(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'en_content' => 'required|string',
                ];
            $msg = [
                'en_content.required' => 'Content is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $aim = Faculty_aims::create($request->all());
            return response($aim);
        }
    }

    /**
     * Edit faculty return information to ajax request
     * @param Request $request
     * @return Response
     */
    public function edit_aims(Request $request, $id)
    {
        if ($request->ajax() || $request->isMethod('get')) {
            $aim = Faculty_aims::find($id);
            return response()->json($aim);
        }
    }

    /**
     * update a record of faculty aims with information of Edit function
     * @param request
     * @return response
     */
    public function update_aims(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'en_content' => 'required|string',
                ];
            $msg = [
                'en_content.required' => 'Content is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            DB::table('faculty_aims')
                ->where('id', $request->id)
                ->update(array(
                    'en_content' => $request->en_content,
                ));
            return response($request->all());
        }
    }

    /**
     * Delete Faculty
     * @param Request $request
     * @return \Response
     */
    public function destroy_aims(Request $request)
    {
        Faculty_aims::destroy($request->id);
        return response(['message' => 'faculty deleted successfully']);
    }

    /**
     * View Grades of faculty
     * @param $id
     * @return View
     */
    public function view_grades($id)
    {
        $faculty_grades = Faculty::find($id)->grades;
        $grades = Grades::all();
        return view('admin.faculty.grades.view', [
            'grades' => $grades,
            'faculty_id' => $id,
            'faculty_grades' => $faculty_grades,
        ]);
    }

    /**
     * Add Aims to Faculty
     * @param Request $request
     * @return Response
     */
    public function add_grades(Request $request)
    {
        if ($request->isMethod('post')) {
            $faculty = $request->input('faculty_id');
            DB::table('faculty_grades')->where('faculty_id', $faculty)->delete();
            $grade = $request->grade_id;
            $percentage = $request->percentage;

            DB::table('faculty_grades')->insert([
                ['faculty_id' => $faculty, 'grades_id' => $request->input('very-good_id'), 'minimum_percentage' => $request->input('very-good')],
                ['faculty_id' => $faculty, 'grades_id' => $request->excellent_id, 'minimum_percentage' => $request->excellent],
                ['faculty_id' => $faculty, 'grades_id' => $request->good_id, 'minimum_percentage' => $request->good],
                ['faculty_id' => $faculty, 'grades_id' => $request->pass_id, 'minimum_percentage' => $request->pass],

            ]);
            return redirect()->back();
        }
    }

}
