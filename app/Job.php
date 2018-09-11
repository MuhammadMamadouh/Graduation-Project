<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

    //
    protected $table = 'job';
    public $timestamps = false;
    protected $fillable = ['en_title', 'ar_title'];

    /*
     * polymorphic relationship bet. Staff, department and job
     * 
     * relation tabel is coordinator
     */

    public function staff() {
        return $this->morphedByMany('App\Staff', 'coordinator');
    }
    
    /*
     * polymorphic relationship bet. Staff, department and job
     * 
     * relation tabel is coordinator
     */

    public function program() {
        return $this->morphedByMany('App\Program', 'coordinator');
    }
    

}
