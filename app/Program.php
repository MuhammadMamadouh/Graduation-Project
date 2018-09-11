<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Program extends Model
{
    //
    protected $table = 'program';
    public $timestamps = false;

    protected $fillable = ['department_id', 'en_name', 'ar_name', 'duration', 'type'];


    /**
     * View Years of Program by 1-M relationship
     * @return Years
     */
    public function years() {
        return $this->hasMany('App\Year');
    }

    /**
     * M-N relationship bet staff and program
     * 
     */
    public function instructors() {
        return $this->belongsToMany('App\Staff', 'instructs_in');
    }

//    /**
//     * Aims of Program
//     * @return program Aims
//     */
//    public function aims() {
//        return $this->hasMany('App\Program_aims');
//    }

    /**
     * ILOs of Program
     */
    public function ilos()
    {
        $id = $this->getKey();
        return DB::table('program_ilos')
            ->join('genre', 'program_ilos.NARS_ILOs_genre_id', 'genre.id')
            ->join('nars_ilos', 'program_ilos.NARS_ILOs_id', 'nars_ilos.id')
            ->select('genre.en_title as genre', 'program_ilos.*', 'nars_ilos.*')
            ->where('program_ilos.program_id', '=', $id);
    }

 /**
     * ILOs of Program
     */
    public function aims()
    {
        $id = $this->getKey();
        return DB::table('program_aims')
            ->join('program', 'program_aims.program_id', 'program.id')
            ->join('nars_aims', 'program_aims.nars_aims_id', 'nars_aims.id')
            ->select('nars_aims.*', 'program_aims.*')
            ->where('program_aims.program_id', '=', $id);
    }


}
