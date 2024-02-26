<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriAvaluacio extends Model
{
    protected $table = "criteris_avaluacio";
    // protected $primaryKey = "id";
    // protected $incrementing = true;
    // protected $keyType = "string";
    public $timestamps = false;

    public function resultatsAprenentage()
    {
        return $this->belongsTo(ResultatAprenentage::class, 'resultats_aprenentatge_id');
    }

    public function rubrica()
    {
        return $this->hasMany(Rubrica::class, 'criteris_avaluacio_id');
    }

    public function usuari_has_criterisAvaluacio()
    {
        return $this->belongsToMany(Usuari::class, 'alumnes_has_criteris_avaluacio', 'criteris_avaluacio_id', 'usuaris_id');
    }
}