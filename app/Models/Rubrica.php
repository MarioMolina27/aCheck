<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubrica extends Model
{
    protected $table = "rubriques";
    // protected $primaryKey = "id";
    // protected $incrementing = true;
    // protected $keyType = "string";
    public $timestamps = false;

    public function criteriAvaluacio()
    {
        return $this->belongsTo(CriteriAvaluacio::class, 'criteris_avaluacio_id');
    }
}