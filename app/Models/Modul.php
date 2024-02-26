<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = "moduls";
    // protected $primaryKey = "id";
    // protected $incrementing = true;
    // protected $keyType = "string";
    public $timestamps = false;

    public function cicle()
    {
        return $this->belongsTo(Cicle::class, 'cicles_id');
    }

    public function resultatsAprenentage()
    {
        return $this->hasMany(ResultatAprenentage::class, 'moduls_id');
    }

    public function usuari_has_moduls()
    {
        return $this->belongsToMany(Usuari::class, 'usuaris_has_moduls', 'moduls_id', 'usuaris_id');
    }
}