<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nars_aims extends Model {

    //
    protected $table = 'nars_aims';

    /**
     * The "type" of the ID.
     * @var string
     */
    protected $keyType = 'varchar';

    public $timestamps = false;
    protected $fillable = ['id', 'en_content', 'ar_content'];

}
