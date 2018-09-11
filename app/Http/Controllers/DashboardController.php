<?php

namespace App\Http\Controllers;

use App\Course;
use App\Degree;
use App\Department;
use App\Faculty;
use App\Genre;
use App\Job;

class dashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function index()
    {
        $degrees     = Degree::all()->count();
        $jobs        = Job::all()->count();
        $faculties   = Faculty::paginate(10);
        $genres = Genre::all();
        return view('admin.dashboard', [
            'degrees'         => $degrees,
            'jobs'           => $jobs,
            'faculties'     => $faculties,
            'genres' => $genres,
        ]);
    }



}
