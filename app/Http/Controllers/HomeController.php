<?php

namespace App\Http\Controllers;

use App\Department;
use App\Events\EventTest;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
      * Show the application dashboard.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
        $department = Department::where('admin', Auth::user()->id)->first();
        return view('home', ['department' => $department,]);
    }

    public function admin()
    {
        return view('admin');
    }

 public function event()
    {
        event(new EventTest('Test From Event'));

        return 'Event Pushed';
    }

    public function upload(Request $request)
    {

        Storage::disk('local')->put('test.txt', $request->text);
        return $request->all();
    }
}
