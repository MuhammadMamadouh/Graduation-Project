<?php

namespace App\Http\Controllers;

use App\TeachingMethod;

use Illuminate\Http\Request;
use Validator;

class TeachingMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    /**
     * Add New method
     *
     * @param Request $request
     * @return view
     */
    public function add(Request $request)
    {
        if ($request->ajax()) {
//if($request->isMethod('post')){
            $rules =
                [
                    'en_title' => 'required|string|unique:teaching_method|max:255',
                ];
            $msg = [
                'en_title.required' => 'Name is required',
                'en_title.unique' => 'This Method has already added'
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $method = new TeachingMethod();
            $method->en_title = $request->en_title;
            $method->save();
            return response($method);
        }
    }

    public function all()
    {
        $methods = TeachingMethod::all();
        return view('admin.teaching_method.view', [
            'methods' => $methods,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $method = TeachingMethod::find($request->id);
            return response()->json($method);
        }
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
                    'en_title' => 'required|string|max:255',
                ];
            $msg = [
                'en_title.required' => 'Name is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $method = TeachingMethod::find($request->id);
            $method->en_title = $request->en_title;
            $method->save();
            return response()->json($method);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $method = TeachingMethod::find($request->id);
        $method->delete();
        return 'success';
    }

}
