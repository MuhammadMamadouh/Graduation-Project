<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Course;
use App\Course_narse;
use App\Department;
use App\EvaluationMethod;
use App\Facility;
use App\Genre;
use App\Grades;
use App\Reference;
use App\Semester;
use App\Staff;
use App\TeachingMethod;
use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Khill\Lavacharts\Laravel\LavachartsFacade;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function showProfile()
    {
        // show department
        $department = Department::where('admin', Auth::user()->id)->first();
        $AuthId = Auth::user()->id;
        $courses = Staff::find($AuthId)->courses;
        return view('user.profile', [
            'courses' => $courses,
            'department' => $department,
        ]);
    }

    public function allow($code)
    {
        $teachers = Course::find($code)->staff;
        foreach ($teachers as $teacher) {
            if (Auth::user()->id !== $teacher->id) {
                return redirect('/notAllowed');
            }
        }
    }

    public function myCourse($code, $tab=null)
    {
        $teachers = Course::find($code)->staff;
//        foreach ($teachers as $teacher) {
//            if (Auth::user()->id !== $teacher->id) {
//                return redirect('notAllowed');
//            }
//        }
        $topics = Course::find($code)->topics()->get();
        $facilities = Course::find($code)->facilities()->get();
        $references = Course::find($code)->references()->get();
        $allFacilities = Facility::all();

        // variables of teaching methods
        $allMethods = TeachingMethod::all();
        $methods = Course::find($code)->teaching_methods()->get();
        $cmethods = DB::table('course_techmethod')->where('course_code', $code);

        // variables of Evaluation methods
        $allEvaluationMethods = EvaluationMethod::all();
        $evaluation_methods = Course::find($code)->evaluation_methods()->get();
        $course_eval_methods = DB::table('course_evaluation_method')->where('course_code', $code);

        $contents = Course::find($code)->contents()->get();
        $course_grades = Course::find($code)->grades();
        $grades = Grades::all();
        $course = DB::table('course')
            ->join('semester', 'course.semester_id', 'semester.id')
            ->join('year', 'year.id', 'semester.year_id')
            ->select('year.name as year_name', 'year.id as year_id',
                'semester.name as sem_name', 'semester.id as sem_id',
                'course.*')
            ->where('course.code', '=', $code)->first();
        $staff = Course::find($code)->staff;

        $gradesChart = LavachartsFacade::DataTable();
        $gradesChart->addStringColumn('grades')->addNumberColumn('grades');
        foreach ($course_grades as $grade) {

            $gradesChart->addRow([$grade->en_name, $grade->students]);
        }
        $lava = LavachartsFacade::ColumnChart('gradesChart', $gradesChart, [
            'title' => 'Grades  Performance',
            'titleTextStyle' => [
                'color' => '#eb6b2c',
                'fontSize' => 14,

            ],

        ]);


        return view('user.course', [
            'course' => $course,
            'staff' => $staff,
            'facilities' => $facilities,
            'topics' => $topics,
            'references' => $references,
            'methods' => $methods,
            'cmethods' => $cmethods,
            'allFacilities' => $allFacilities,
            'allMethods' => $allMethods,
            'contents' => $contents,
            'course_code' => $code,
            'evaluation_methods' => $evaluation_methods,
            'allEvaluationMethods' => $allEvaluationMethods,
            'course_eval_methods' => $course_eval_methods,
            'course_grades' => $course_grades,
            'grades' => $grades,
            'lava' => $lava,
            'tab' => $tab,

        ]);
    }


//    ----------------- Facility ------------------

    public function addFacility(Request $request)
    {
        if ($request->isMethod('post')) {

            $code = $request->input('course_code');

            $ids = $request->input('facility_id');

            $facilities = DB::table('course_facilities')->where('course_code', $code)->delete();
            foreach ($ids as $id) {
                DB::table('course_facilities')->insert([
                    'course_code' => $code,
                    'facility_id' => $id,
                ]);
            }
            return back();
        }
    }

//    ----------------- Facility ------------------

    public function addGrades(Request $request)
    {
        if ($request->isMethod('post')) {

            $code = $request->input('course_code');
            $course = Course::find($code);


            $students = $request->excellent + $request->input('very-good') + $request->good + $request->pass + $request->fail;
            if ($course->students != $students) {
                return response('Number of students you entered is not equal to number of students of this course');
            }
            DB::table('course_grades')->where('course_code', $code)->delete();

            DB::table('course_grades')->insert([
                ['course_code' => $code, 'grades_id' => $request->excellent_id, 'students' => $request->excellent],
                ['course_code' => $code, 'grades_id' => $request->input('very-good_id'), 'students' => $request->input('very-good')],
                ['course_code' => $code, 'grades_id' => $request->good_id, 'students' => $request->good],
                ['course_code' => $code, 'grades_id' => $request->pass_id, 'students' => $request->pass],
                ['course_code' => $code, 'grades_id' => $request->fail_id, 'students' => $request->fail],

            ]);
            return response($request->all());
        }
    }


//-------------------- TOPIC METHODS ---------------------

    public function addTopic(Request $request)
    {
        if ($request->isMethod('post')) {
            Content::create($request->all());
            return back();
        }
    }

    public function delTopic(Request $request)
    {
        if ($request->isMethod('post')) {
            Content::destroy($request->id);
            return response(['message' => 'Topic Deleted Successfully']);
        }
    }

    public function edit_topic(Request $request)
    {
        if ($request->ajax()) {
            $topic = Content::find($request->id);
            return response($topic);
        }
    }

    public function update_topic(Request $request)
    {
        if ($request->ajax()) {
            Content::where('id', $request->id)
                ->update([
                    'en_topic' => $request->en_topic,
                    'ar_topic' => $request->ar_topic,
                ]);
            return response($request->all());
        }
    }


//    --------------- REFERENCE -----------------

    public function addReference(Request $request)
    {
        if ($request->isMethod('post')) {
            Reference::create($request->all());
            return back();
        }
    }

    public function delReference(Request $request)
    {
        Reference::destroy($request->id);
        return response(['message' => 'reference deleted successfully']);
    }

    public function edit_reference(Request $request)
    {
        if ($request->ajax()) {
            $reference = Reference::find($request->id);
            return response($reference);
        }
    }

    public function update_reference(Request $request)
    {
        if ($request->ajax()) {
            Reference::where('id', $request->id)
                ->update([
                    'en_name' => $request->en_name,
                    'ar_name' => $request->ar_name,
                    'desc' => $request->desc,
                ]);
            return response($request->all());
        }
    }

//    ---------------- TEACHING METHODS -----------------
    public function addMethod(Request $request)
    {
        if ($request->isMethod('post')) {
            $ids = $request->input('method_id');
            $code = $request->input('course_code');
            $methods = DB::table('course_techmethod')->where('course_code', $code)->delete();
            foreach ($ids as $id) {
                $method = DB::table('course_techmethod')->insert([
                    'course_code' => $code,
                    'teaching_method_id' => $id,
                ]);
            }
            return back();
        }
    }

//    ---------------- Evaluation METHODS -----------------
    public function add_evaluation_method(Request $request)
    {
        if ($request->isMethod('post')) {
            $ids = $request->input('eval_method_id');
            $code = $request->input('course_code');
            $methods = DB::table('course_evaluation_method')->where('course_code', $code)->delete();
            foreach ($ids as $id) {
                $method = DB::table('course_evaluation_method')->insert([
                    'course_code' => $code,
                    'evaluation_method_id' => $id,
                ]);
            }
            return back();
        }
    }


    /**
     * View Course ILOs by code of cuorse
     * @param $id
     * @return View
     *
     * SELECT program.id as program_id FROM `course`
     * inner JOIN semester on semester.id = course.semester_id
     * inner JOIN year on year.id = semester.year_id
     * inner JOIN program  on program.id = year.program_id
     */
    public function view_program_ilos($code)
    {
        $program = DB::table('course')
            ->join('semester', 'semester.id', 'course.semester_id')
            ->join('year', 'year.id', 'semester.year_id')
            ->join('program', 'program.id', 'year.program_id')
            ->select('program.id')
            ->first();
        $course_ilos = DB::table('course_ilos')->where('course_code', '=', $code)->get();
        $program_ilos = DB::table('program_ilos')
            ->join('genre', 'program_ilos.NARS_ILOs_genre_id', 'genre.id')
            ->join('nars_ilos', 'program_ilos.NARS_ILOs_id', 'nars_ilos.id')
            ->select('genre.en_title as genre', 'program_ilos.*', 'nars_ilos.*')
            ->where('program_ilos.program_id', '=', $program->id)
            ->get();
        return view('user.ilos.add', [
            'program_ilos' => $program_ilos,
            'course_code' => $code,
            'course_ilos' => $course_ilos,
        ]);
    }

    public function course_ilos($code)
    {
        $course_ilos = Course::find($code)->ilos();
        $program_ilos = DB::table('program_ilos')->get();
        $genres = Genre::all();
//        $course_ilos = Course::find($code)->ilos;, 'nars_ilos.*'
        return view('user.ilos.view', [
            'course_ilos' => $course_ilos,
            'course_code' => $code,
            'program_ilos' => $program_ilos,
            'genres' => $genres,
        ]);
    }

    /*
     * ADD ILOs to course
    * @param Request $request
     * @return json response
    */
    public function add_course_ilos(Request $request)
    {
        if ($request->isMethod('post')) {
//        if ($request->ajax()) {
            DB::table('course_ilos')->insert([
                'program_ILOs_program_id' => $request->program_id,
                'program_ILOs_NARS_ILOs_id' => $request->nars_ilos_id,
                'program_ILOs_NARS_ILOs_genre_id' => $request->genre_id,
                'course_code' => $request->course_code,
            ]);
            return redirect()->back();
        }
    }

    /*
    * Add Course ILOs
    * @param Request $request
     * @return json response
    */
    public function delete_course_ilos(Request $request)
    {
        if ($request->isMethod('post')) {
            DB::table('course_ilos')
                ->where('program_ILOs_NARS_ILOs_id', '=', $request->nars_id)
                ->where('program_ILOs_NARS_ILOs_genre_id', '=', $request->genre_id)
                ->where('program_ILOs_program_id', '=', $request->program_id)
                ->where('course_code', '=', $request->course_code)
                ->delete();
            return redirect()->back();
            return response($request->all());
        }
    }

    /**
     * View Course ILOs by codeof cuorse
     * @param $id
     * @return View
     */
    public function view_program_aims($code)
    {
        $program = DB::table('course')
            ->join('semester', 'semester.id', 'course.semester_id')
            ->join('year', 'year.id', 'semester.year_id')
            ->join('program', 'program.id', 'year.program_id')
            ->select('program.id')
            ->first();
        $course_ilos = DB::table('course_aims')->where('course_code', '=', $code)->get();
        $program_aims = DB::table('program_aims')
            ->join('nars_aims', 'program_aims.nars_aims_id', 'nars_aims.id')
            ->select('program_aims.*', 'nars_aims.*')
            ->where('program_aims.program_id', '=', $program->id)
            ->get();
        return view('user.aims.add', [
            'program_aims' => $program_aims,
            'course_code' => $code,
            'course_ilos' => $course_ilos,
        ]);
    }

    public function course_aims($code)
    {
        $course_aims = DB::select("SELECT program_aims.*,course_aims.* FROM `course_aims`
                        INNER JOIN program_aims on program_aims.program_id = course_aims.program_aims_program_id
                        WHERE course_aims.program_aims_nars_aim_id= program_aims.nars_aims_id
                        AND course_aims.course_code = '$code'");
        $course_aims = Course::find($code)->aims();
        return view('user.aims.view', [
            'course_aims' => $course_aims,
            'course_code' => $code,
        ]);
    }

    /*
     * ADD ILOs to course
    * @param Request $request
     * @return json response
    */
    public function add_course_aims(Request $request)
    {
        if ($request->isMethod('post')) {
//        if ($request->ajax()) {
            DB::table('course_aims')->insert([
                'program_aims_program_id' => $request->program_id,
                'program_aims_nars_aim_id' => $request->nars_ilos_id,
                'course_code' => $request->course_code,
            ]);
            return redirect()->back();
        }
    }

    /*
    * Add Course ILOs
    * @param Request $request
     * @return json response
    */
    public function delete_course_aims(Request $request)
    {
        if ($request->isMethod('post')) {
            DB::table('course_aims')
                ->where('program_aims_nars_aim_id', '=', $request->nars_id)
                ->where('program_aims_program_id', '=', $request->program_id)
                ->where('course_code', '=', $request->course_code)
                ->delete();
            return redirect()->back();
            return response($request->all());
        }
    }


    public function report($code)
    {

        $topics = Course::find($code)->topics()->get();
        $facilities = Course::find($code)->facilities()->get();
        $references = Course::find($code)->references()->get();

        // variables of teaching methods
        $methods = Course::find($code)->teaching_methods()->get();

        // variables of Evaluation methods
        $evaluation_methods = Course::find($code)->evaluation_methods()->get();
        $course_eval_methods = DB::table('course_evaluation_method')->where('course_code', $code);

        $course_aims = DB::select("SELECT program_aims.*,course_aims.* FROM `course_aims`
                        INNER JOIN program_aims on program_aims.program_id = course_aims.program_aims_program_id
                        WHERE course_aims.program_aims_nars_aim_id= program_aims.nars_aims_id
                        AND course_aims.course_code = '$code'");


        $course = DB::table('course')
            ->join('semester', 'course.semester_id', 'semester.id')
            ->join('year', 'year.id', 'semester.year_id')
            ->select('year.name as year_name', 'year.id as year_id',
                'semester.name as sem_name', 'semester.id as sem_id',
                'course.*')
            ->where('course.code', '=', $code)->first();

        $staff = DB::select("SELECT staff.en_name, staff.id,job.en_title as job,work_at.job_id, academic_degree.en_degree as degree
                            FROM teach
                            INNER JOIN staff ON staff.id = teach.staff_id
                            INNER JOIN academic_degree ON staff.academic_degree_id = academic_degree.id
                            INNER JOIN work_at ON work_at.staff_id = staff.id
                            INNER JOIN job ON job.id = work_at.job_id
                            WHERE teach.course_code ='$code'");


        $course_ilos = DB::select("SELECT program_ilos.update, course_ilos.* FROM `course_ilos` 
                            INNER JOIN program_ilos ON course_ilos.program_ILOs_program_id = program_ilos.program_id
                            where program_ilos.NARS_ILOs_id = course_ilos.program_ILOs_NARS_ILOs_id
                            AND program_ilos.NARS_ILOs_genre_id = course_ilos.program_ILOs_NARS_ILOs_genre_id
                            and course_ilos.course_code ='$code'");
        $genres = Genre::all();
        $course_grades = Course::find($code)->grades();
        $gradesChart = LavachartsFacade::DataTable();
        $gradesChart->addStringColumn('grades')->addNumberColumn('grades');
        foreach ($course_grades as $grade) {

            $gradesChart->addRow([$grade->en_name, $grade->students]);
        }
        $lava = LavachartsFacade::ColumnChart('gradesChart', $gradesChart, [
            'title' => 'Grades  Performance',
            'titleTextStyle' => [
                'color' => '#eb6b2c',
                'fontSize' => 14,
            ],
        ]);

        return view('user.report', [
            'course' => $course,
            'staff' => $staff,
            'facilities' => $facilities,
            'topics' => $topics,
            'references' => $references,
            'methods' => $methods,
            'course_aims' => $course_aims,
            'course_code' => $code,
            'course_ilos' => $course_ilos,
            'evaluation_methods' => $evaluation_methods,
            'course_eval_methods' => $course_eval_methods,
            'genres' => $genres,
            'course_grades' => $course_grades,
//            'grades' => $grades,
            'lava' => $lava,

        ]);
    }
}
