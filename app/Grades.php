<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grades extends Model {
    //
    protected $table = 'grades';
    public $timestamps = false;
    protected $fillable = ['en_name', 'ar_name'];

}
