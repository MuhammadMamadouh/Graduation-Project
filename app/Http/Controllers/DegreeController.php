<?php

namespace App\Http\Controllers;

use App\Degree;
use Illuminate\Http\Request;
use Validator;

class DegreeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Add New degree
     *
     * @param Request $request
     * @return view
     */
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'en_degree' => 'required|string|unique:academic_degree|max:255',
                ];
            $msg = [
                'en_degree.required' => 'Name is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $degree = Degree::create($request->all());
            return response($degree);
        }
    }

    public function all()
    {
        $degrees = Degree::all();
        return view('admin.degree.view', [
            'degrees' => $degrees,
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
            $degree = Degree::findOrFail($request->id);
            return response()->json($degree);
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
                    'en_degree' => 'required|string|max:255',
                ];
            $msg = [
                'en_degree.required' => 'Name is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $degree = Degree::findOrFail($request->id);
            $degree->en_degree = $request->en_degree;
            $degree->save();
            return response()->json($degree);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $degree = Degree::find($request->id);
        $degree->delete();
        return 'success';
    }

}
