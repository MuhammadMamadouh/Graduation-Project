<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_aims extends Model {

    //
    protected $table = 'course_aims';
    public $timestamps = false;
    protected $fillable = ['en_content','ar_content', 'course_code'];

}
