<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty_aims extends Model {

    //
    protected $table = 'faculty_aims';
    public $timestamps = false;
    protected $fillable = ['en_content', 'ar_content', 'faculty_id'];

}
