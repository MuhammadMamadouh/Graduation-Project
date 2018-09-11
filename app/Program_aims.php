<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program_aims extends Model {

    //
    protected $table = 'program_aims';
    public $timestamps = false;
    protected $fillable = ['nars_aims_id', 'program_id'];

}
