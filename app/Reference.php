<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'reference';
    public $timestamps = false;

protected $fillable = ['ar_name', 'en_name', 'desc', 'course_code'];
}
