<?php

namespace App\Http\Controllers;

use App\Grades;
use Illuminate\Http\Request;
use Validator;

class GradesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Add New grade
     *
     * @param Request $request
     * @return view
     */
    public function add(Request $request)
    {
        if($request->isMethod('post')){
//        if ($request->ajax()) {
            $rules =
                [
                    'en_name' => 'required|string|unique:grades|max:255',
                ];
            $msg = [
                'en_name.required' => 'Name is required',
                'en_name.unique' => 'Name is already taken',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $grade = Grades::create($request->all());
            return response($grade);
//        return redirect()->back();
        }
    }

    public function all()
    {
        $grades = Grades::all();
        return view('admin.grades.view', [
            'grades' => $grades,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->ajax()){
            $grade = Grades::findOrFail($request->id);
            return response()->json($grade);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        if($request->ajax()){
          if($request->isMethod('post')){
            $rules =
                [
                    'en_name' => 'required|string|max:255',
                ];
            $msg = [
                'en_name.required' => 'Name is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $grade = Grades::findOrFail($request->id);
            $grade->en_name = $request->en_name;
            $grade->save();
            return response()->json($grade);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $grade = Grades::find($request->id);
        $grade->delete();
        return 'success';
    }

}
