<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Genre;
use App\Nars_aims;
use App\Program_aims;
//use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

use App\Program;
use App\Year;
use App\Staff;
use App\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Validator;

class ProgramController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Add New program
     *
     * @param Request $request
     * @return view
     */
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'en_name' => 'required|string|max:100',
                    'duration' => 'required|numeric|min:2',
                    'type' => 'string|max:45',
                ];
            $msg = [
                'en_name.required' => 'Name is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
//            $program = Program::create($request->all());
            $program = new Program();
            $program->en_name = $request->en_name;
            $program->duration = $request->duration;
            $program->type = $request->type;
            $program->department_ID = $request->department_ID;
            $program->save();
            return response($program);
        }
    }

    /**
     * View program by id
     * @param $id
     * @return View
     */
    public function view($fid, $did, $id)
    {
        $this->middleware('DepartAdmin');
        $program = Program::where('id', $id)->first();
        $department = Department::find($did);
        // check if the auth is not admin of the department

        $years = Program::find($id)->years()->orderby('name')->get();
        // Coordinators of The Program

        $genres = Genre::all();

        $url = URL::current();

        return view('admin.program.view', [
            'program' => $program,
            'years' => $years,
            'genres' => $genres,
            'url' => $url,
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
        $program = Program::find($request->id);
        $program->delete();
        return 'success';
    }

    /**
     * Edit faculty return information to ajax request
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request, $fid, $did, $id)
    {
        $this->middleware('DepartAdmin');
        if ($request->isMethod('get')) {
            $program = Program::find($id);
            return view('admin.program.update', ['program' => $program]);
        }
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
                    'en_name' => 'required|string|max:255',
                ];
            $msg = [
                'en_name.required' => 'NAME is required',
//                'fax.required'       => 'fax is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }

            $id = $request->input('id');

            $en_name = $request->input('en_name');
            $type = $request->input('type');
            $vision = $request->input('vision');
            $mession = $request->input('mession');
            $duration = $request->input('duration');
            $program = Program::find($id);
            $program->en_name = $en_name;
            $program->duration = $duration;
            $program->type = $type;
            $program->vision = $vision;
            $program->mession = $mession;
            $program->save();
            return response($program);
        }
    }

    public function all($fid, $did)
    {
        $programs = Department::find($did)->programs;

        return view('admin.program.all', [
        'programs' => $programs,
        ]);
    }


    /**
     * View Program ILOs by id of program
     * @param $id
     * @return View
     */
    public function program_ilos($fid, $did, $id)
    {
        $this->middleware('DepartAdmin');
        $program_ilos = Program::find($id)->ilos()->paginate(10);
        return view('admin.program.ilos.view', [
            'program_ilos' => $program_ilos,
            'program_id' => $id,
        ]);
    }

    /*
    * Add Program ILOs
    * @param Request $request
     * @return json response
    */
    public function add_program_ilos(Request $request)
    {

        if ($request->isMethod('post')) {

            DB::table('program_ilos')->insert([
                'program_id' => $request->program_id,
                'NARS_ILOs_id' => $request->nars_ilos_id,
                'NARS_ILOs_genre_id' => $request->genre_id,
                'update' => $request->update,
            ]);

//            return response($request->all());
            return redirect()->back();


        }
    }

    /*
       * Edit Program ILOs
       * @param Request $request
        * @return json response
       */
    public function edit_program_ilos(Request $request)
    {
        if ($request->isMethod('post')) {

            DB::table('program_ilos')
                ->where('program_id', '=', $request->program_id)
                ->where('NARS_ILOs_id', '=', $request->nars_ilos_id)
                ->where('NARS_ILOs_genre_id', '=', $request->genre_id)
                ->update(['update' => $request->update]);
//            ]);

//            return response($request->all());
            return redirect()->back();
        }
    }

    /*
     * Delete Program Aims
     * @param Request $request
      * @return json response
     */
    public function delete_program_ilos(Request $request)
    {
//        if ($request->ajax()) {
        if ($request->isMethod('post')) {
            $program_ilos = DB::table('program_ilos')
                ->where('NARS_ILOs_id', '=', $request->nars_id)
                ->where('NARS_ILOs_genre_id', '=', $request->genre_id)
                ->where('program_id', '=', $request->program_id)
                ->delete();
            return response($request->all());
        }
    }


//    ------------------ Program Aims --------------------

    /**
     * View Program Aims by id of program
     * @param $fid for faculty
     * @param $did for department
     * @param $id for program
     * @return View
     */
    public function program_aims($fid, $did, $id)
    {
        $this->middleware('DepartAdmin');
        $program_aims = Program::find($id)->aims()->paginate(10);
        return view('admin.program.aims.view', [
            'program_aims' => $program_aims,
            'program_id' => $id,
        ]);
    }

    /*
    * Add Program Aims
    * @param Request $request
     * @return json response
    */
    public function add_program_aims(Request $request)
    {
        if ($request->isMethod('post')) {
            $old_program_aims = DB::table('program_aims')
                ->where('program_id', $request->program_id)
                ->where('nars_aims_id', $request->nars_aims_id)
                ->get();
            if(count($old_program_aims) == 0) {
                $program_aims = new Program_aims();
                $program_aims->program_id = $request->program_id;
                $program_aims->nars_aims_id = $request->nars_aims_id;
                if ($old_program_aims)
                    $program_aims->save();
                return redirect()->back();
            }else{
                return redirect()->back()->with('error', 'This NARS aims already added to this program');
            }
        }
    }

    /*
      * Delete Program Aims
      * @param Request $request
       * @return json response
      */
    public function delete_program_aims(Request $request)
    {
//        if ($request->ajax()) {
        if ($request->isMethod('post')) {
            $program_aims = DB::table('program_aims')->where('nars_aims_id', '=', $request->nars_id)
                ->where('program_id', '=', $request->program_id)
                ->delete();
            return response($request->all());
        }
    }

    /*
    * Edit Program ILOs
    * @param Request $request
     * @return json response
    */
    public function edit_program_aims(Request $request)
    {
        if ($request->isMethod('post')) {

            DB::table('program_aims')
                ->where('program_id', '=', $request->program_id)
                ->where('nars_aims_id', '=', $request->nars_aims_id)
                ->update(['update' => $request->update]);
//            ]);

//            return response($request->all());
            return redirect()->back();
        }
    }


    public function view_report($fid, $did, $id)
    {
        $this->middleware('DepartAdmin');
        $program = Program::find($id);
        $department = Department::find($program->department_ID);
        $faculty = Faculty::find($department->faculty_id);
        $faculty_aims = Faculty::find($department->faculty_id)->aims();
        $program_aims = Program::find($id)->aims()->get();
        $program_ilos = Program::find($id)->ilos()->get();
        $all_staff = Department::find($did)->staff()->get();
        $department = Department::find($program->department_ID);
        $coo =  DB::table('work_at')
            ->join('staff', 'work_at.staff_id', 'staff.id')
            ->join('job', 'work_at.job_id', 'job.id')
            ->join('academic_degree', 'staff.academic_degree_id', 'academic_degree.id')
            ->select('staff.en_name', 'staff.mobile', 'staff.email', 'staff.id', 'academic_degree.en_degree as degree',
                'academic_degree.id as degree_id', 'job.en_title as job', 'work_at.start_date')
            ->where('work_at.department_id', $did)
            ->where('work_at.job_id', '1')
            ->orWhere('work_at.job_id', '2')->get();

        return view('admin.program.view_report', [
            'program' => $program,
            'program_aims' => $program_aims,
            'department' => $department,
            'faculty' => $faculty,
            'faculty_aims' => $faculty_aims,
            'program_ilos' => $program_ilos,
            'all_staff' => $all_staff,
            'coordinators' => $coo,
        ]);
    }

    /**
     * View Course ILOs by code of cuorse
     * @param $id
     * @return View
     *
     * SELECT program.id as program_id FROM `course`
     * inner JOIN semester on semester.id = course.semester_id
     * inner JOIN year on year.id = semester.year_id
     * inner JOIN program  on program.id = year.program_id
     */
    public function nars_aims($fid, $did, $pid)
    {
        $this->middleware('DepartAdmin');
        $nars = Nars_aims::paginate(10);
        $department = Department::where('admin', '=', Auth::user()->id)->first();

        if ($department != null) {
            $programs_aims = Program_aims::all();
            $programs = Department::findOrFail($department->id)->programs;
            return view('admin.program.aims.nars_aims', [
                'nars' => $nars,
                'department' => $department,
                'programs' => $programs,
                'program_aims' => $programs_aims,
            ]);
        } else {
            return view('admin.program.aims.nars_aims', [
                'nars' => $nars,
            ]);

        }
    }

    /**
     * View Course ILOs by codeof cuorse
     * @param $id
     * @return View
     *
     * SELECT program.id as program_id FROM `course`
     * inner JOIN semester on semester.id = course.semester_id
     * inner JOIN year on year.id = semester.year_id
     * inner JOIN program  on program.id = year.program_id
     */
    public function nars_ilos($fid, $did, $pid, $gid)
    {
        $this->middleware('DepartAdmin');
        // department that the user is administrator
        $department = Department::where('admin', '=', Auth::user()->id)->first();
        $genres = Genre::find($gid)->get();
//        $nars = DB::table('nars_ilos')
//            ->join('genre', 'nars_ilos.genre_id', 'genre.id')
//            ->select('genre.*', 'nars_ilos.*')
//            ->where('nars_ilos.genre_id', '=', $gid)->paginate(10);
        $nars = Genre::find($gid)->nars_ilos()->paginate(10);
        if ($department != null) {
            // find programs of department that the user is administrator
            $programs = Department::findOrFail($department->id)->programs;
            $program_ilos = DB::table('program_ilos')->get();

            return view('admin.program.ilos.nars_ilos', [
                'nars' => $nars,
                'genres' => $genres,
                'programs' => $programs,
                'program_ilos' => $program_ilos,
            ]);

        } else {
            return view('admin.program.ilos.nars_ilos', [
                'nars' => $nars,
                'genres' => $genres,
            ]);
        }
    }
}
