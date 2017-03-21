<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 21/03/2017
 * Time: 11:15
 */

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadEstratigrafica extends Model
{
    protected $table = 'unidadestratigrafica';
    protected $primaryKey = 'UE';
    public $timestamps = false;

    /*protected $fillable = [
        'Descripcion', 'PartesOseasEspecieEdad'
    ];*/
}