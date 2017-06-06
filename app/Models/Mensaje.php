<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Mensaje extends Model
{

    protected $table = 'mensajesusuario';
    protected $primaryKey = 'id_mensaje';
    public $timestamps = false;

}