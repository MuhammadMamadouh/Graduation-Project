<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    //
    protected $table = 'department';
    public $timestamps = false;

    protected $fillable = [
        'ar_name', 'en_name', 'faculty_id', 'admin'
    ];

//    /*
//     * relationship M-N bet. Staff and department
//     *
//     * relation tabel is work_at
//     */
//    public function staff()
//    {
//        return $this->belongsToMany('App\Staff', 'work_at');
//    }

    /**
     * programs of Department
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programs()
    {
        return $this->hasMany('App\Program');
    }

    /**
     * Coorrdinators of Department
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coordinators($id)
    {
//        $did = $this->getKey();
        return DB::table('work_at')
            ->join('staff', 'work_at.staff_id', 'staff.id')
            ->join('job', 'work_at.job_id', 'job.id')
            ->join('academic_degree', 'staff.academic_degree_id', 'academic_degree.id')
            ->select('staff.en_name', 'staff.mobile', 'staff.email', 'staff.id', 'academic_degree.en_degree as degree',
                'academic_degree.id as degree_id', 'job.en_title as job', 'work_at.start_date')
            ->where('work_at.department_id', $id)
            ->where('work_at.job_id', '1')
            ->orWhere('work_at.job_id', '2');
    }

    /**
     * Coorrdinators of Department
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staff()
    {
        $id = $this->getKey();
        return DB::table('work_at')
            ->join('staff', 'work_at.staff_id', 'staff.id')
            ->join('job', 'work_at.job_id', 'job.id')
            ->join('academic_degree', 'staff.academic_degree_id', 'academic_degree.id')
            ->select('staff.en_name', 'staff.mobile', 'staff.email', 'staff.id', 'academic_degree.en_degree as degree',
                'academic_degree.id as degree_id', 'job.en_title as job', 'work_at.start_date')
            ->where('work_at.department_id', $id);
    }

public function admin(){
        $id = $this->getKey();
    return DB::table('department')
        ->join('staff', 'staff.id', 'department.admin')
        ->select('staff.en_name', 'staff.mobile', 'staff.email', 'staff.id'
        )->where('department.id', $id)->first();
}
}
