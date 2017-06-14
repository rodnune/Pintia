<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ParteObjeto extends Model
{

    protected $table = 'parteobjeto';
    protected $primaryKey = 'idparte';

    public function materialesAsociados(){

        $medidas = DB::table('materiaprima')
            ->join('materialobjeto', function ($join) {
                $join->on('materiaprima.idmat', '=', 'materialobjeto.idmat')
                    ->where('materialobjeto.idparte', '=', $this->IdParte);
            })
            ->get();

        return $medidas;
    }

    public function materialesNoAsociados(){
        $no_asociadas = DB::table('materiaprima')->whereNotIn('materiaprima.idmat',function($q){
            $q->select('materialobjeto.idmat')->from('materialobjeto')
                ->where('materialobjeto.idparte','=',$this->IdParte);
        })->get();

        return $no_asociadas;
    }

}