<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model {

    //
    protected $table = 'academic_degree';
    public $timestamps = false;
    protected $fillable = ['en_degree', 'ar_degree'];

}
