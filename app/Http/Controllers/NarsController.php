<?php

namespace App\Http\Controllers;

use App\Course_narse;
use App\Department;
use App\Genre;
use App\Nars_aims;
use App\Nars_ILOs;
use App\Program;
use App\Program_aims;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class NarsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function all_nars_aims()
    {
        $nars = Nars_aims::paginate(10);
        $department = Department::where('admin', '=', Auth::user()->id)->first();

        if ($department != null) {
            $programs_aims = Program_aims::all();
            $programs = Department::findOrFail($department->id)->programs;
            return view('admin.nars.aims.view', [
                'nars' => $nars,
                'department' => $department,
                'programs' => $programs,
                'program_aims' => $programs_aims,
            ]);
        } else {
            return view('admin.nars.aims.view', [
                'nars' => $nars,
            ]);

        }
    }

    /**
     * Add New NARS aims by Ajax
     * @param Request $request
     * @return view
     */
    public function add_nars_aims(Request $request)
    {
        if ($request->ajax()) {
            $nars_aims = Nars_aims::create($request->all());
            return response($nars_aims);
        }
    }

    /**
     * Edit Nars-aims return information to ajax request
     * @param Request $request
     * @return Response
     */
    public function edit_nars_aims(Request $request)
    {
        if ($request->ajax() || $request->isMethod('get')) {
            $faculty = Nars_aims::find($request->id);
            return response()->json($faculty);
        }
    }

    /**
     * Delete NARS Aims
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy_nars_aims(Request $request)
    {
        Nars_aims::destroy($request->id);
        return response(['message' => 'NARS Aim deleted successfully']);
    }

    /**
     * update record of faculty with information of Edit function
     * @param request
     * @return response
     */
    public function update_nars_aims(Request $request)
    {
        if ($request->ajax()) {
//        if ($request->isMethod('post')) {
            $rules =
                [
                    'en_content' => 'required|string',
                    'id' => 'required|string|max:10',
                ];
            $msg = [
                'en_content.required' => 'CONTENT is required',
                'id.required' => 'Code is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }

            $nars_aim = Nars_aims::find($request->id);

            $nars_aim->id = $request->id;
            $nars_aim->en_content = $request->en_content;
            $nars_aim->save();
            return response($nars_aim);
//            return redirect()->back();
        }
    }



//    ================= NARS ILOs METHODS ===================

    /**
     * Nars ILOs
     * @param $id program id
     * @param $code genre id
     * @return View
     */
    public function all_nars_ilos($code)
    {
        // department that the user is administrator
        $department = Department::where('admin', '=', Auth::user()->id)->first();
        $genres = Genre::find($code)->get();
        $nars = Genre::find($code)->nars_ilos()->paginate(10);
        if ($department != null) {
            // find programs of department that the user is administrator
            $programs = Department::findOrFail($department->id)->programs;
            $program_ilos = DB::table('program_ilos')->get();

            return view('admin.nars.ilos.view', [
                'nars' => $nars,
                'genres' => $genres,
                'programs' => $programs,
                'program_ilos' => $program_ilos,
            ]);

        } else {
            return view('admin.nars.ilos.view', [
                'nars' => $nars,
                'genres' => $genres,
            ]);
        }


    }

    public function add_nars_ilos(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'id' => 'required|string|unique:NARS_ILOs|max:10',
                    'en_content' => 'required|string',

                ];
            $msg = [
                'en_content.required' => 'CONTENT is required',
                'id.required' => 'Code is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $nars_ilos = Nars_ILOs::create($request->all());
            return response($nars_ilos);
        }
    }


    /**
     * Delete NARS Aims
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy_nars_ilos(Request $request)
    {
        Nars_ILOs::destroy($request->id);
        return response(['message' => 'NARS Aim deleted successfully']);
    }


    /**
     * Edit Nars-aims return information to ajax request
     * @param Request $request
     * @return Response
     */
    public function edit_nars_ilos(Request $request)
    {
        if ($request->ajax() || $request->isMethod('get')) {
            $faculty = Nars_ILOs::find($request->id);
            return response()->json($faculty);
        }
    }

    /**
     * update record of faculty with information of Edit function
     * @param request
     * @return response
     */
    public function update_nars_ilos(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'id' => 'required|string|max:10',
                    'en_content' => 'required|string',

                ];
            $msg = [
                'en_content.required' => 'CONTENT is required',
                'id.required' => 'Code is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $id = $request->id;
            $nars_ilos = Nars_ILOs::find($id);

            $nars_ilos->id = $request->id;
            $nars_ilos->en_content = $request->en_content;
            $nars_ilos->genre_id = $request->genre_id;
            $nars_ilos->save();
            return response($nars_ilos);
        }
    }

}

