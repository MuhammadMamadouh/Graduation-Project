<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facility';
    public $timestamps = false;


    protected $fillable = [
        'ar_title', 'en_title',
    ];


}
