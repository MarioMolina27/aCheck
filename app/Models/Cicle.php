<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cicle extends Model
{
    protected $table = "cicles";
    // protected $primaryKey = "id";
    // protected $incrementing = true;
    // protected $keyType = "string";
    public $timestamps = false;

    public function moduls()
    {
        return $this->hasMany(Modul::class, 'cicles_id');
    }
}