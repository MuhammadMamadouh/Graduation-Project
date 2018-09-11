<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Faculty extends Model
{

    //
    protected $table = 'faculty';
    public $timestamps = false;

    protected $fillable = ['en_name', 'ar_name', 'fax', 'telephone'];

    /**
     * Departments of Faculty
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments()
    {
        return $this->hasMany('App\Department');
    }

    /**
     * Aims of Faculty
     * @return Faculty Aims
     */
    public function aims()
    {

       return DB::table('nars')->select('id', 'code', 'description')
            ->where('category', '=', 'aims')
            ->where('faculty_id', '=', $this->getKey());
//        return $this->hasMany('App\Faculty_aims');
    }

    /**
     * Grades of Faculty
     * @return Faculty grades
     */
    public function grades()
    {
        return $this->belongsToMany('App\Grades')->withPivot('minimum_percentage');
    }
//
//    public function get_aims(){
//        return DB::select("SELECT course_grades.*, grades.* from course_grades
//                            INNER JOIN grades ON grades.id = course_grades.grades_id
//                            WHERE course_grades.course_code = ''");
//    }

}
