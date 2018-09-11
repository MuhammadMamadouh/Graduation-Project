<?php

namespace App\Http\Controllers;

use App\Year;
use Validator;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Add New Year
     *
     * @param Request $request
     * @return view
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
                $rules =
                    [
                        'name' => 'required|numeric|unique:year|',
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

            $year = Year::create($request->all());
            return response($year);
        }
    }

    public function view($fid,$did, $pid, $year)
    {
        $this->middleware('DepartAdmin');
        $id = $year;
        $year = Year::find($id);
        $semesters = Year::find($id)->semesters()->get();

        return view('admin.year.view', [
            'semesters' => $semesters,
            'year' => $year,
        ]);
    }

    public function all($fid, $did, $pid){
        $years = Year::all();
        return view('admin.year.all', ['years' => $years]);
    }
    /**
     * Edit year return information to ajax request
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request, $fid,$did, $pid, $id)
    {
        $this->middleware('DepartAdmin');
        if ($request->isMethod('get')) {
            $year = Year::find($id);
            return view('admin.year.update', ['year' => $year]);
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
                    'name' => 'required|numeric|max:2',
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
            $year = Year::find($id);
            $year->name = $name;
            $year->start_date = $start_date;
            $year->end_date = $end_date;
            $year->status = $status;
            $year->en_desc = $desc;
            $year->save();
            return response($year);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $year = Year::find($request->id);
        $year->delete();
        return 'success';
    }

}
