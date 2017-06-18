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


    public function multimediasAsociados(){

        $asociados = DB::table('almacenmultimedia')
            ->join('multimediaobjeto', function ($join) {
                $join->on('almacenmultimedia.idmutimedia', '=', 'multimediaobjeto.idmutimedia')
                    ->where('multimediaobjeto.ref', '=', $this->Ref);
            })
            ->get();

        return $asociados;
    }

    public function multimediasNoAsociados(){

        $no_asociados = DB::table('almacenmultimedia')->whereNotIn('almacenmultimedia.idmutimedia',function($q){
            $q->select('multimediaobjeto.idmutimedia')->from('multimediaobjeto')->where('multimediaobjeto.ref','=',$this->Ref);
        })
            ->get();


        return $no_asociados;

    }

    public function camposCompletados(){

        $pendientes = DB::table('camposobjeto')->whereNotIn('camposobjeto.idcampo',function($q){
            $q->select('pendienteobjeto.idcampo')->from('pendienteobjeto')->where('pendienteobjeto.ref','=',$this->Ref);
        })
            ->get();

        return $pendientes;
    }

    public function camposPendientes(){

        $pendientes = DB::table('camposobjeto')
            ->join('pendienteobjeto', function ($join) {
                $join->on('camposobjeto.idcampo', '=', 'pendienteobjeto.idcampo')
                    ->where('pendienteobjeto.ref', '=', $this->Ref);
            })
            ->get();

        return $pendientes;
    }

}