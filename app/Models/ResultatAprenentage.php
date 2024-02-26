<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultatAprenentage extends Model
{
    protected $table = "resultats_aprenentatge";
    // protected $primaryKey = "id";
    // protected $incrementing = true;
    // protected $keyType = "string";
    public $timestamps = false;

    public function moduls()
    {
        return $this->belongsTo(Modul::class, 'moduls_id');
    }

    public function criterisAvaluacio()
    {
        return $this->hasMany(CriteriAvaluacio::class, 'resultats_aprenentatge_id');
    }
}