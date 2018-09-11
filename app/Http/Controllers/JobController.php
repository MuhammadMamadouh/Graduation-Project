<?php

namespace App\Http\Controllers;

use App\Department;
use App\Job;
use App\Semester;
use App\Year;
use Illuminate\Http\Request;
use App\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    /**
     * Add New job
     *
     * @param Request $request
     * @return view
     */
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $job = Job::create($request->all());
            return response($job);
        }
    }

    public function viewAllJobs()
    {
        $jobs = Job::all();
        return view('admin.job.view', [
            'jobs' => $jobs,
        ]);
    }
 
   public function all()
    {
        $jobs = Job::all();
        return view('admin.job.all', [
            'jobs' => $jobs,
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
            $job = Job::findOrFail($request->id);
            return response()->json($job);
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

            $job = Job::find($request->id);
            $job->en_title = $request->en_title;
            $job->save();
            return response()->json($job);
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
        $job = Job::find($request->id);
        $job->delete();
        return 'success';
    }

}
