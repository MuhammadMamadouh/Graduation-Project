<?php

namespace App\Http\Controllers;

use App\EvaluationMethod;
use Validator;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Add New evaluation_method
     *
     * @param Request $request
     * @return view
     */
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'en_method' => 'required|string|max:255',
                ];
            $msg = [
                'en_method.required' => 'Name is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $evaluation_method = new EvaluationMethod();
            $evaluation_method->en_method = $request->en_method;
            $evaluation_method->save();
            return response($evaluation_method);
        }
    }

    public function all()
    {
        $evaluation_methods = EvaluationMethod::all();
        return view('admin.evaluation_method.view', [
            'evaluation_methods' => $evaluation_methods,
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
            $evaluation_method = EvaluationMethod::find($request->id);
            return response()->json($evaluation_method);
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
        if($request->ajax()){
            $rules =
                [
                    'en_method' => 'required|string|max:255',
                ];
            $msg = [
                'en_method.required' => 'Name is required',
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $evaluation_method = EvaluationMethod::find($request->id);
            $evaluation_method->en_method = $request->en_method;
            $evaluation_method->save();
            return response()->json($evaluation_method);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $evaluation_method = EvaluationMethod::find($request->id);
        $evaluation_method->delete();
        return 'success';
    }

}
