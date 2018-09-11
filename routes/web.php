<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
 */
Auth::routes();

Route::get('/', 'ProfileController@showProfile')->name('profile');

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/charts', 'ChartsController@chart')->name('charts');

//-------------- user Profile and courses methods --------------

Route::get('/profile', 'ProfileController@showProfile')->name('profile');

Route::get('/mycourse/{code}', 'ProfileController@myCourse');
Route::post('/mycourse/add-facility', 'ProfileController@addFacility')->name('addFacility');

Route::post('/mycourse/add-method', 'ProfileController@addMethod')->name('addMethod');
Route::post('/mycourse/add-evaluation-method', 'ProfileController@add_evaluation_method')->name('addEvalMethod');
Route::post('/mycourse/del-method', 'ProfileController@delMethod')->name('delMethod');
Route::get('/edit-method', 'ProfileController@edit_method')->name('updMethod');

Route::post('/mycourse/add-reference', 'ProfileController@addReference')->name('addReference');
Route::post('/mycourse/del-reference', 'ProfileController@delReference')->name('delReference');
Route::get('/edit-reference', 'ProfileController@edit_reference');
Route::post('/update-reference', 'ProfileController@update_reference')->name('updRef');

Route::post('/mycourse/add-topic', 'ProfileController@addTopic')->name('addTopic');
Route::post('/mycourse/del-topic', 'ProfileController@delTopic');
Route::get('/edit-topic', 'ProfileController@edit_topic');
Route::post('/update-topic', 'ProfileController@update_topic')->name('updTopic');

Route::post('/mycourse/add-aims', 'ProfileController@add_course_aims')->name('addCourseAims');

Route::get('/mycourse/{code}/program-ilos', 'ProfileController@view_program_ilos')->name('viewCourseIlos');
Route::get('/mycourse/{code}/ilos', 'ProfileController@course_ilos')->name('viewCourseIlos');
Route::post('/mycourse/add-ilos', 'ProfileController@add_course_ilos')->name('addCourseIlos');
Route::post('/mycourse/del-ilos', 'ProfileController@delete_course_ilos')->name('delCourseIlos');

Route::get('/mycourse/{code}/program-aims', 'ProfileController@view_program_aims')->name('viewCourseAims');
Route::get('/mycourse/{code}/aims', 'ProfileController@course_aims')->name('viewCourseAims');
Route::post('/mycourse/add-aims', 'ProfileController@add_course_aims')->name('addCourseAims');
Route::post('/mycourse/del-aims', 'ProfileController@delete_course_aims')->name('delCourseAims');

Route::get('/mycourse/{code}/report', 'ProfileController@report')->name('viewCourseReport');

Route::get('/notAllowed', function () {
    return view('errors.notAllowed');
});

//grades of Course

//update aims of faculty
Route::get('/mycourse/grades/{id}/edit', 'ProfileController@addGrades')->name('EditCourseGrades');
Route::post('/mycourse/grades/update', 'ProfileController@addGrades')->name('EditCourseGrades');

// add Staff To department
//Route::get('/admin/staff/add-to-depart/d={id}', 'StaffController@addStaffToDepart');

Route::get('/test', 'HomeController@index');
Route::get('/event', 'HomeController@event');
Route::get('/send', function () {

    $job = (new \App\Jobs\sendMail())->delay(\Carbon\Carbon::now()->addSecond(5));
    dispatch($job);
    return "Mail Sent";
});
Route::post('/upload_file', 'HomeController@upload')->name('upload');