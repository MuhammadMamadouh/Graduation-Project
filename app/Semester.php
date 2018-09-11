<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //
    protected $table='semester';
    public $timestamps = false;

    protected $fillable = [
        'year_id',  'name', 'start_date', 'end_date',
        'status', 'ar_desc', 'en_desc',
    ];
    
    public function year() {
        return $this->belongsTo('App\Year');
    }
}
