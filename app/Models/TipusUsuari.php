<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipusUsuari extends Model
{
    protected $table = "tipus_usuaris";
    // protected $primaryKey = "id";
    // protected $incrementing = true;
    // protected $keyType = "string";
    public $timestamps = false;

    public function usuaris()
    {
        return $this->hasMany(Usuari::class, 'tipus_usuari_id');
    }
}