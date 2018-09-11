<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Staff extends Model {

    //
    protected $table = 'staff';
    public $timestamps = false;

    protected $fillable = ['en_name', 'ar_name', 'email', 'password', 'mobile', 'academic_degree_id', 'admin'];

    public function department() {
        return $this->belongsToMany('App\Department', 'work_at');
    }

    /*
     * polymorphic relationship bet. Staff, department and job
     * 
     * relation tabel is coordinator
     */

    public function job() {
        return $this->morphToMany('App\Job', 'coordinator');
    }

    
    /**
     * M-N relationship bet staff and program
     * 
     */
    public function programs() {
        return $this->belongsToMany('App\Program', 'instructs_in');
    }
    
    /**
     * M-N relationship bet staff and program
     * 
     */
    public function courses() {
        return $this->belongsToMany('App\Course', 'teach');
    }



    /**
     * View staff
     *
     */
    public function view() {

        $id = $this->getKey();
        return DB::table('work_at')
            ->join('department', 'department.id', 'work_at.department_id')
            ->join('staff', 'staff.id', 'work_at.staff_id')
            ->join('job', 'job.id', 'work_at.job_id')
            ->join('academic_degree', 'staff.academic_degree_id', 'academic_degree.id')
            ->join('faculty', 'department.faculty_id', 'faculty.id')
            ->select('staff.*', 'department.id as dep_id', 'department.en_name as dep_name',
                'faculty.id as fac_id', 'faculty.en_name as fac_name', 'academic_degree.en_degree as degree', 'job.en_title as job')
            ->where('work_at.staff_id', '=', $id)
            ->first();
    }


}
