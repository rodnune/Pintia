<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Inhumacion extends Model
{

    protected $table = 'inhumacion';
    protected $primaryKey = 'IdEnterramiento';
    public $timestamps = false;



    public function registro(){
        $registro = DB::table('registro')
            ->where('IdEnterramiento','=',$this->IdEnterramiento)
            ->select('registro.NumControl')
            ->first();

        return $registro;

    }
}