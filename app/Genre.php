<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model {

    //
    protected $table = 'genre';
    public $timestamps = false;
    protected $fillable = ['en_title', 'ar_title'];


    /**
     * NARS ILOs of Genre
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nars_ilos()
    {
        $id = $this->getKey();
        return DB::table('nars_ilos')
            ->join('genre', 'nars_ilos.genre_id', 'genre.id')
            ->select('genre.*', 'nars_ilos.*')
            ->where('nars_ilos.genre_id', '=', $id);
    }


}
