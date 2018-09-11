<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    //
    protected $table='year';
    public $timestamps = false;

    protected $fillable = [
        'name', 'start_date', 'end_date',
        'status', 'ar_desc', 'en_desc', 'program_id',
        ];

    /**
     * View Semester of Years by 1-M relationship
     * @return Semsters
     */
    public function semesters() {
        return $this->hasMany('App\Semester');
    }
}
