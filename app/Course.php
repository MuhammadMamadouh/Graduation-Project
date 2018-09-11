<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    //
    protected $table = 'course';
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'code';
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'varchar';


    /**
     * M-N relationship bet staff and program
     *
     */
    public function staff()
    {
        return $this->belongsToMany('App\Staff', 'teach');
    }

    public function topics()
    {
        return $this->hasMany('App\Content');
    }


    public function facilities()
    {
        return $this->belongsToMany('App\Facility', 'course_facilities');
    }

    public function references()
    {
        return $this->hasMany('App\Reference', 'course_code');
    }

    public function contents()
    {
        return $this->hasMany('App\Contents', 'course_code');
    }

    public function teaching_methods()
    {
        return $this->belongsToMany('App\TeachingMethod', 'course_techmethod');
    }

    public function evaluation_methods()
    {
        return $this->belongsToMany('App\EvaluationMethod', 'course_evaluation_method');
    }

    /**
     * Aims of Course
     * @return Course Aims
     */
    public function ilos()
    {
        $code = $this->getKey();
        return DB::select("SELECT program_ilos.*, course_ilos.* FROM `course_ilos`
                                  INNER JOIN program_ilos ON course_ilos.program_ILOs_program_id = program_ilos.program_id
                                  where program_ilos.NARS_ILOs_id = course_ilos.program_ILOs_NARS_ILOs_id
                                  AND program_ilos.NARS_ILOs_genre_id = course_ilos.program_ILOs_NARS_ILOs_genre_id
                                  AND program_ilos.program_id = course_ilos.program_ILOs_program_id
                                  AND course_ilos.course_code ='$code'");
    }

    public function aims()
    {
        $code = $this->getKey();
        return DB::select("SELECT program_aims.*,course_aims.* FROM `course_aims`
                        INNER JOIN program_aims on program_aims.program_id = course_aims.program_aims_program_id
                        WHERE course_aims.program_aims_nars_aim_id= program_aims.nars_aims_id
                        AND course_aims.course_code = '$code'");
    }

    public function grades()
    {
        $code = $this->getKey();
        return DB::select("SELECT course_grades.*, grades.* from course_grades
                            INNER JOIN grades ON grades.id = course_grades.grades_id
                            WHERE course_grades.course_code = '$code'");
    }

}
