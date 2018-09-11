<?php

namespace App\Http\Controllers;
use App\Facility;
use Illuminate\Http\Request;
use Validator;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    /**
     * Add New facility
     *
     * @param Request $request
     * @return view
     */
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $rules =
                [
                    'en_title' => 'required|string|unique:Facility|max:255',
                ];
            $msg = [
                'en_title.required' => 'Name is required',
                'en_title.unique' => 'This Facility has already added '
            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails()) {
                return response($validator->errors(), 401);
            }
            $facility = new Facility();
            $facility->en_title = $request->en_title;
            $facility->save();
            return response($facility);
        }
    }

    public function all()
    {
        $facilities = Facility::all();
        return view('admin.facility.view', [
            'facilities' => $facilities,
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
            $facility = Facility::find($request->id);
            return response()->json($facility);
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
            $facility = Facility::find($request->id);
            $facility->en_title = $request->en_title;
            $facility->save();
            return response()->json($facility);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $facility = Facility::find($request->id);
        $facility->delete();
        return 'success';
    }
}
