<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class ParteObjeto extends Model
{

    protected $table = 'parteobjeto';
    protected $primaryKey = 'idparte';

    public function materialesAsociados(){

        $materiales = DB::table('materiaprima')
            ->join('materialobjeto', function ($join) {
                $join->on('materiaprima.idmat', '=', 'materialobjeto.idmat')
                    ->where('materialobjeto.idparte', '=', $this->IdParte);
            })
            ->get();

        return $materiales;
    }

    public function materialesNoAsociados(){
        $no_asociadas = DB::table('materiaprima')->whereNotIn('materiaprima.idmat',function($q){
            $q->select('materialobjeto.idmat')->from('materialobjeto')
                ->where('materialobjeto.idparte','=',$this->IdParte);
        })->get();

        return $no_asociadas;
    }

    public function medidasAsociadasCategoria(){

        $medidas = DB::table('medidas')
            ->join('medidascategoria', function ($join) {
                $join->on('medidas.siglasmedida', '=', 'medidascategoria.siglasmedida')
                    ->where('medidascategoria.idcat', '=', $this->idCat);
            })
            ->select('medidas.SiglasMedida','medidas.Denominacion','medidas.Unidades','medidascategoria.IdCat')
            ->get();

        return $medidas;
    }


    public function medidasAsociadasSubcategoria(){

        $medidas = DB::table('medidas')
            ->join('medidassubcategoria', function ($join) {
                $join->on('medidas.siglasmedida', '=', 'medidassubcategoria.siglasmedida')
                    ->where('medidassubcategoria.idsubcat', '=', $this->IdSubcat);
            })
            ->select('medidas.SiglasMedida','medidas.Denominacion','medidas.Unidades','medidassubcategoria.IdCat','medidassubcategoria.IdSubcat')
            ->get();

        return $medidas;
    }

    public function medidasParteObjeto(){

        $medidas = DB::table('medidas')
            ->join('medidasobjeto', function ($join) {
                $join->on('medidas.siglasmedida', '=', 'medidasobjeto.siglasmedida')
                    ->where('medidasobjeto.idparte', '=', $this->IdParte);
            })
            ->select('medidas.SiglasMedida','medidas.Denominacion','medidas.Unidades','medidasobjeto.IdParte','medidasobjeto.Valor')
            ->get();

            return $medidas;

    }




}