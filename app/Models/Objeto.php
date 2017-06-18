<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 09/02/2017
 * Time: 10:14
 */

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Objeto extends Model
{
    protected $table = 'fichaobjeto';
    protected $primaryKey = 'ref';


    public function partesObjeto(){

        $partes = DB::table('parteobjeto')
            ->where('ref','=',$this->Ref)
            ->get();

        return $partes;
    }

    public function articulosAsociados(){
        $asociados = DB::table('articulos')
            ->join('publicadoen', function ($join) {
                $join->on('articulos.idarticulo', '=', 'publicadoen.idarticulo')
                    ->where('publicadoen.ref', '=', $this->Ref);
            })
            ->select('articulos.IdArticulo','articulos.Titulo')
            ->get();

        return $asociados;

    }


    public function articulosNoAsociados(){

        $no_asociados = DB::table('articulos')->whereNotIn('articulos.idarticulo',function($q){
            $q->select('publicadoen.idarticulo')->from('publicadoen')->where('publicadoen.ref','=',$this->Ref);
        })
            ->select('articulos.IdArticulo','articulos.Titulo')
            ->get();


        return $no_asociados;


    }

}