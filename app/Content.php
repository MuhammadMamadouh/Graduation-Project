<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    public $timestamps = false;

    protected $fillable = [
        'ar_topic', 'en_topic', 'course_code',
        'actually_taught', 'en_reasons_for_not_teaching',
        'ar_reasons_for_not_teaching', 'in_course' ];
}
