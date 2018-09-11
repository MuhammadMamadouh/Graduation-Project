<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    protected $table = 'contents';
    public $timestamps = false;

    protected $fillable = [
        'ar_content',
        'en_content',
        'course_code'
    ];
}
