<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationMethod extends Model
{
    protected $table = 'evaluation_method';
    public $timestamps = false;

    protected $fillable = ['ar_method', 'en_method'];



}
