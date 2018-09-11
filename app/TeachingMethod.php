<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachingMethod extends Model
{
    protected $table = 'teaching_method';
    public $timestamps = false;

    protected $fillable = ['en_title', 'ar_title'];


}
