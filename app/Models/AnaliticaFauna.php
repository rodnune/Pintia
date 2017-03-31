<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AnaliticaFauna extends Model
{

    protected $table = 'analiticafaunas';
    protected $primaryKey = 'IdAnalitica';
    public $timestamps = false;

    protected $fillable = [
        'Descripcion', 'PartesOseasEspecieEdad'
    ];

}