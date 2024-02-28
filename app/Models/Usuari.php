<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Usuari extends Authenticable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "usuaris";
    // protected $primaryKey = "id";
    // protected $incrementing = true;
    // protected $keyType = "string";
    public $timestamps = false;

    protected $fillable = [
        'nom_usuari', 'contrasenya', 'correu', 'nom', 'cognom', 'actiu', 'tipus_usuaris_id'
    ];


    public function tipusUsuari()
    {
        return $this->belongsTo(TipusUsuari::class, 'tipus_usuaris_id');
    }

    public function moduls()
    {
        return $this->belongsToMany(Modul::class, 'usuaris_has_moduls', 'usuaris_id', 'moduls_id');
    }

    public function criterisAvaluacio()
    {
        return $this->belongsToMany(CriteriAvaluacio::class, 'alumnes_has_criteris_avaluacio', 'usuaris_id', 'criteris_avaluacio_id');
    }
}