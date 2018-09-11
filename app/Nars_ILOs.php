<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nars_ILOs extends Model
{

    //Table name
    protected $table = 'nars_ilos';

    /**
     * The "type" of the ID.
     * @var string
     */
    protected $keyType = 'varchar';

    public $timestamps = false;
    protected $fillable = ['id', 'en_content', 'ar_content', 'genre_id'];

    /**
     * ILOs of Program
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function programs()
    {
        return $this->belongsToMany('App\Program', 'program_ilos')->as('NARS_ILOs_id');
    }


}
