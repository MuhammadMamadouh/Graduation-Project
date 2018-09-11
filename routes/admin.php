<?php

Route::group(['prefix' => 'admin'], function () {


    Route::get('/routes', 'HomeController@admin')->middleware('admin');

    Route::get('/admins', 'AdminController@showAdmins');
    Route::post('/add_admin', 'AdminController@add_admin')->name('addAdmin');
    Route::post('admin/remove', 'AdminController@remove_admin')->name('removeAdmin');


// view Faculty
    Route::get('/faculty/{id}', 'FacultyController@view');
    Route::get('/faculties', 'FacultyController@all')->name('faculties');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
// add Faculty
    Route::post('/faculty/add', 'FacultyController@add')->name('addFaculty');
// delete Faculty
    Route::post('/faculty/delete', 'FacultyController@destroy');

//upadate Faculty
    Route::get('/faculty/{id}/edit', 'FacultyController@edit');
    Route::post('/faculty/update', 'FacultyController@update');
//aims of faculty
    Route::get('/faculty/{id}/aims', 'FacultyController@view_aims')->name('viewFacultyAims');
//update aims of faculty
    Route::get('/faculty/aims/{aim_id}/edit', 'FacultyController@edit_aims')->name('EditFacultyAim');
    Route::post('/faculty/aims/update', 'FacultyController@update_aims')->name('EditFacultyAim');

//add aims of faculty
    Route::post('/faculty/aims/add', 'FacultyController@add_aims')->name('addFacultyAim');
    Route::post('/faculty/aims/delete', 'FacultyController@destroy_aims');

//grades of Faculty
    Route::get('/faculty/{id}/grades', 'FacultyController@view_grades')->name('viewFacultyGrades');
//update aims of faculty
    Route::get('/faculty/grades/{id}/edit', 'FacultyController@edit_grades')->name('EditFacultyGrades');
    Route::post('/faculty/grades/update', 'FacultyController@update_grades')->name('EditFacultyGrades');
//add aims of faculty
    Route::post('/faculty/grades/add', 'FacultyController@add_grades')->name('addFacultyGrade');
    Route::post('/faculty/grades/delete', 'FacultyController@destroy_grades');

//--------------------- DEPARTMENTS -----------------------------

// for add teacher ajax method
    Route::get('/department/view-all/f={id}', 'DepartmentController@viewAllDepartments');
    Route::get('/staff/view-all/d={id}', 'CourseController@viewAllStaffs');


// view Department
    Route::get('/faculty/{fid}/department/{did}', 'DepartmentController@viewDepartment')->name('viewDepartment');
    Route::get('/faculty/{fid}/departments', 'DepartmentController@all')->name('allDepartment');
// add Department
    Route::post('/department/add', 'DepartmentController@add_department')->name('addDepartment');
// delete department
    Route::post('/department/delete', 'DepartmentController@destroy');

    Route::get('/faculty/{fid}/department/{did}/coordinators', 'DepartmentController@view_coordinators')->name('coordinators');
    Route::get('/faculty/{fid}/department/{did}/staffs', 'DepartmentController@department_staff')->name('staffOfDepartment');

    Route::post('/department/add-admin', 'DepartmentController@add_admin')->name('addDepartAdmin');
    Route::post('/department/del-admin', 'DepartmentController@remove_admin')->name('delDepartAdmin');

//--------------------- PROGRAM LINKS -----------------------------

// add Program
    Route::get('/faculty/{fid}/department/{did}/program/add', 'ProgramController@index')->name('addProgram');
    Route::post('/program/add', 'ProgramController@add')->name('addProgram');
// view Program
    Route::get('/faculty/{fid}/department/{did}/program/{id}', 'ProgramController@view')->name('viewProgram');

    //all programs
    Route::get('/faculty/{fid}/department/{did}/programs', 'ProgramController@all')->name('allProgram');
// Delete Program
    Route::post('/program/delete', 'ProgramController@destroy');

//upadate Program
    Route::get('/faculty/{fid}/department/{did}/program/{pid}/edit', 'ProgramController@edit')->name('editProgram');
    Route::post('/program/update', 'ProgramController@update')->name('editProgram');


//program aims
    Route::get('/faculty/{fid}/department/{did}/program/{id}/nars_aims', 'ProgramController@nars_aims');

    Route::get('/faculty/{fid}/department/{did}/program/{id}/aims', 'ProgramController@program_aims')->name('viewProgramAims');
    Route::post('/program/add-aims', 'ProgramController@add_program_aims')->name('addProgramAims');
    Route::post('/program/del-aims', 'ProgramController@delete_program_aims')->name('delProgramAims');
    Route::post('/program/edit-aims', 'ProgramController@edit_program_aims')->name('editProgramAims');

//program ilos
    Route::get('/faculty/{fid}/department/{did}/program/{pid}/nars_ilos/{gid}', 'ProgramController@nars_ilos');
    Route::get('/faculty/{fid}/department/{did}/program/{id}/ilos', 'ProgramController@program_ilos')->name('viewProgramIlos');
    Route::post('/program/add-ilos', 'ProgramController@add_program_ilos')->name('addProgramIlos');
    Route::post('/program/del-ilos', 'ProgramController@delete_program_ilos')->name('delProgramIlos');
    Route::post('/program/edit-ilos', 'ProgramController@edit_program_ilos')->name('editProgramIlos');

    Route::get('/faculty/{fid}/department/{did}/program/{id}/report', 'ProgramController@view_report')->name('viewReport');

    Route::get('/program/{id}/pdf', 'ProgramController@pdf_report');


//--------------------- YEARS -----------------------------

// add Year
    Route::post('/year/add', 'YearController@add')->name('addYear');
// view Year
    Route::get('/faculty/{fid}/department/{did}/program/{pid}/year/{year}', 'YearController@view');

    //all years
    Route::get('/faculty/{fid}/department/{did}/program/{pid}/years', 'YearController@all')->name('allYears');
// update year
    Route::get('/faculty/{fid}/department/{did}/program/{pid}/year/{year}/edit', 'YearController@edit');
    Route::post('/year/update', 'YearController@update')->name('editYear');

    Route::post('/year/delete', 'YearController@destroy')->name('delYear');
// add Semester

    Route::post('/semester/add', 'SemesterController@add_semester')->name('addSemester');
// view Semester
    Route::get('/faculty/{fid}/department/{did}/program/{pid}/year/{year}/semester/{id}', 'SemesterController@viewSemester');
    Route::get('/faculty/{fid}/department/{did}/program/{pid}/year/{year}/semesters', 'SemesterController@all');
    Route::get('/faculty/{fid}/department/{did}/program/{pid}/year/{year}/semester/{id}/courses', 'CourseController@all');
    Route::post('/semester/update', 'SemesterController@update')->name('editSemester');
    Route::post('/semester/delete', 'SemesterController@destroy')->name('delSemester');


// add Course
    Route::post('/course/add', 'CourseController@add')->name('addCourse');
// view Course
    Route::get('/course/view-all', 'CourseController@viewAllCourses');
    Route::get('/faculty/{fid}/department/{did}/program/{pid}/year/{year}/semester/{id}/course/{code}', 'CourseController@view');
    Route::post('/course/delete', 'CourseController@destroy')->name('delCourse');
    Route::post('/course/update', 'CourseController@update')->name('editCourse');
    Route::get('/course/{code}/add-content', 'CourseController@add_content')->name('addContent');
    Route::post('/course/{code}/add-content', 'CourseController@add_content')->name('addContent');

// add Course teacher
    Route::post('/course/add-teacher', 'CourseController@add_teacher')->name('addTeacher');
    Route::post('/course/del-teacher', 'CourseController@delete_teacher')->name('delTeacher');


//--------------------- Staff -----------------------------


// add staff To department
    Route::post('/staff/addstaff', 'StaffController@add')->name('addStaff');
    Route::post('/staff/delete', 'StaffController@destroy')->name('delStaff');
    Route::post('/staff/add', 'StaffController@add')->name('addStaff');
    Route::post('/staff/edit', 'StaffController@edit')->name('editStaff');
// view Staff
    Route::get('/staff/view/{code}', 'StaffController@view')->name('viewStaff');

    Route::get('/pdf', 'ProgramController@pdf');


    Route::get('/jobs/all', 'JobController@all');

// add job for staff of faculty

    Route::post('/job/add', 'JobController@add')->name('addJob');
// view job
    Route::get('/job/view-all', 'JobController@viewAllJobs')->name('viewJobs');
    Route::post('/job/delete', 'JobController@destroy')->name('delJob');
    Route::get('/job/edit', 'JobController@edit');
    Route::post('/job/update', 'JobController@update')->name('editJob');

//------------------------- Degree Links --------------------

// add degree for staff of facility
    Route::post('/facility/add', 'FacilityController@add')->name('facilityAdd');
    Route::post('/facility/delete', 'FacilityController@destroy')->name('facilityDel');
    Route::get('/facility/edit', 'FacilityController@edit');
    Route::post('/facility/update', 'FacilityController@update')->name('facilityEdit');
    Route::get('/facility/view-all', 'FacilityController@all')->name('facilityView');
//------------------------- Facilty Links --------------------
// add degree for staff of faculty
    Route::post('/degree/add', 'DegreeController@add')->name('addDegree');

    Route::post('/degree/delete', 'DegreeController@destroy')->name('delDegree');
    Route::get('/degree/edit', 'DegreeController@edit');
    Route::post('/degree/update', 'DegreeController@update')->name('editDegree');
    Route::get('/degree/view-all', 'DegreeController@all')->name('viewDegrees');
    Route::get('/degree/allDegrees', function (){
        $degrees = App\Degree::all();
        return view('admin.degree.all', ['degrees' => $degrees]);
    });

// add Evaluation Methods used in courses for staff of faculty
    Route::post('/evaluation-method/add', 'EvaluationController@add')->name('addEvaluationMethod');
    Route::post('/evaluation-method/delete', 'EvaluationController@destroy')->name('delEvalMethod');
    Route::get('/evaluation-method/edit', 'EvaluationController@edit');
    Route::post('/evaluation-method/update', 'EvaluationController@update')->name('editEvalMethod');
// view All Evaluation Methods For
    Route::get('/evaluation-method/view-all', 'EvaluationController@all')->name('viewEvalMethods');
    Route::get('/evaluation-method/allMethods', function (){
        $evaluation_methods = App\EvaluationMethod::all();
        return view('admin.evaluation_method.all', ['evaluation_methods' => $evaluation_methods]);
    });

// add Evaluation Methods used in courses for staff of faculty
    Route::post('/teaching-method/add', 'TeachingMethodController@add')->name('addTeachMethod');
    Route::post('/teaching-method/delete', 'TeachingMethodController@destroy')->name('delTeachMethod');
    Route::get('/teaching-method/edit', 'TeachingMethodController@edit');
    Route::post('/teaching-method/update', 'TeachingMethodController@update')->name('editTeachMethod');
// view All Teaching Methods For
    Route::get('/teaching-method/view-all', 'TeachingMethodController@all')->name('viewTeachMethods');

    Route::get('/teaching-method/allMethods', function (){
        $methods = App\TeachingMethod::all();
        return view('admin.teaching_method.all', ['methods' => $methods]);
    });

//--------------- Genre Links -------------
// add genre for staff of faculty
    Route::post('/genre/add', 'GenreController@add')->name('addGenre');
// view job
    Route::get('/genre/all', 'GenreController@all')->name('viewGenres');
    Route::post('/genre/delete', 'GenreController@destroy')->name('delGenre');
    Route::get('/genre/edit', 'GenreController@edit');
    Route::post('/genre/update', 'GenreController@update')->name('editGenre');

//--------------- Grades Links -------------
// add grade for staff of faculty
    Route::post('/grade/add', 'GradesController@add')->name('addGrade');
// view job
    Route::get('/grade/all', 'GradesController@all')->name('viewGrade');
    Route::post('/grade/delete', 'GradesController@destroy')->name('delGrade');
    Route::get('/grade/edit', 'GradesController@edit');
    Route::post('/grade/update', 'GradesController@update')->name('editGrade');

    //add aims of faculty
    Route::post('/faculty/grades/add', 'FacultyController@add_grades')->name('addFacultyGrade');
    Route::post('/faculty/grades/delete', 'FacultyController@destroy_grades');



// ------------------- NARS METHODS ------------------

// add NARS-Aims
    Route::post('/nars-aims/add', 'NarsController@add_nars_aims')->name('addNarsAims');
    Route::get('/nars-aims/edit', 'NarsController@edit_nars_aims')->name('editNarsAims');
    Route::post('/nars-aims/edit', 'NarsController@update_nars_aims')->name('updateNarsAims');
    Route::post('/nars-aims/delete', 'NarsController@destroy_nars_aims')->name('delNarsAims');
// view NARS-Aims
    Route::get('/nars-aims/view-all', 'NarsController@all_nars_aims')->name('viewNarsAims');

// add NARS-ILOs
    Route::post('/nars-ilos/add', 'NarsController@add_nars_ilos')->name('addNarsILOs');

    Route::get('/nars-ilos/edit', 'NarsController@edit_nars_ilos')->name('editNarsILOs');
    Route::post('/nars-ilos/edit', 'NarsController@update_nars_ilos')->name('updateNarsILOs');

    Route::post('/nars-ilos/delete', 'NarsController@destroy_nars_ilos')->name('delNarsILOs');
// view NARS-ILOs
    Route::get('/nars-ilos/{code}', 'NarsController@all_nars_ilos')->name('viewNarsIlos');

});