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

class Tumba extends Model
{
    protected $table = 'tumba';
    protected $primaryKey = 'idtumba';


    public function tiposTumbaAsociados(){

        $asociadas = DB::table('tipostumbas')
            ->join('tumbaesdetipo', function ($join) {
                $join->on('tipostumbas.idtipotumba', '=', 'tumbaesdetipo.idtipotumba')
                    ->where('tumbaesdetipo.idtumba', '=', $this->IdTumba);
            })
            ->get();

        return $asociadas;


    }

    public function tiposTumbaSinAsociar(){



        $no_asociadas = DB::table('tipostumbas')->whereNotIn('tipostumbas.idtipotumba',function($q){
            $q->select('tumbaesdetipo.idtipotumba')->from('tumbaesdetipo')->where('tumbaesdetipo.idtumba','=',$this->IdTumba);
        })->get();


        return $no_asociadas;



        }


    public function cremacionesAsociadas(){

        $asociadas = DB::table('cremacion')
            ->join('cremacionestumba', function ($join) {
                $join->on('cremacionestumba.idcremacion', '=', 'cremacion.idcremacion')
                    ->where('cremacionestumba.idtumba', '=', $this->IdTumba);
            })
            ->get();

        return $asociadas;

    }

    public function cremacionesSinAsociar(){

        $no_asociadas = DB::table('cremacion')->whereNotIn('cremacion.idcremacion',function($q){
            $q->select('cremacionestumba.idcremacion')->from('cremacionestumba')->where('cremacionestumba.idtumba','=',$this->IdTumba);
        })->get();


        return $no_asociadas;

    }

    public function inhumacionesAsociadas(){

        $asociadas = DB::table('inhumacion')
            ->join('inhumacionestumba', function ($join) {
                $join->on('inhumacionestumba.identerramiento', '=', 'inhumacion.identerramiento')
                    ->where('inhumacionestumba.idtumba', '=', $this->IdTumba);
            })
            ->get();


       return $asociadas;
    }


    public function inhumacionesSinAsociar(){

        $no_asociadas = DB::table('inhumacion')->whereNotIn('inhumacion.identerramiento',function($q){
            $q->select('inhumacionestumba.identerramiento')->from('inhumacionestumba')
                ->where('inhumacionestumba.idtumba','=',$this->IdTumba);
        })->get();


        return $no_asociadas;

    }

    public function localizacion()
    {
       $localizacion = DB::table('localizacion')
        ->join('tumba', function ($join) {
            $join->on('localizacion.idlocalizacion', '=', 'tumba.localizacion')
                ->where('tumba.idtumba', '=', $this->IdTumba);
        })
        ->first();


        return $localizacion;
    }

       public function localizacionesNoAsociadas(){
           $localizaciones = DB::select(DB::raw('SELECT a.IdLocalizacion, a.SiglaZona, a.SectorTrama, a.SectorSubtrama
								FROM
									Localizacion a
								
								ORDER BY SiglaZona'


           ));

           return $localizaciones;
       }


       public function ofrendasAsociadas(){
           $ofrendas = DB::table('analiticafaunas')
               ->join('ofrendasfauna', function ($join) {
                   $join->on('analiticafaunas.idanalitica', '=', 'ofrendasfauna.idanalitica')
                       ->where('ofrendasfauna.idtumba', '=', $this->IdTumba);
               })
               ->get();

           return $ofrendas;

       }

    public function ofrendasNoAsociadas(){


        $no_asociadas = DB::table('analiticafaunas')->whereNotIn('analiticafaunas.idanalitica',function($q){
            $q->select('ofrendasfauna.idanalitica')->from('ofrendasfauna')
                ->where('ofrendasfauna.idtumba','=',$this->IdTumba);
        })->get();



        return $no_asociadas;

    }


    public function multimediaAsociado(){

        $multimedias = DB::table('almacenmultimedia')
            ->join('multimediatumba', function ($join) {
                $join->on('almacenmultimedia.idmutimedia', '=', 'multimediatumba.idmultimedia')
                    ->where('multimediatumba.idtumba', '=', $this->IdTumba);
            })
            ->get();

        return $multimedias;
    }

    public function multimediaNoAsociado(){

        $no_asociados = DB::table('almacenmultimedia')->whereNotIn('almacenmultimedia.idmutimedia',function($q){
            $q->select('multimediatumba.idmultimedia')->from('multimediatumba')
                ->where('multimediatumba.idtumba','=',$this->IdTumba);
        })->get();



        return $no_asociados;
    }


    public function objetosAsociados(){



        $objetos = DB::table('fichaobjeto')
            ->where('idtumba','=',$this->IdTumba)
            ->get(['Ref','NumeroSerie','VisibleCatalogo']);

        return $objetos;
    }


    public function camposCompletados(){

        $completados = DB::table('campostumba')->whereNotIn('campostumba.idcampo',function($q){
            $q->select('pendientetumba.idcampo')->from('pendientetumba')->where('pendientetumba.idtumba','=',$this->IdTumba);
        })
            ->orderBy('campostumba.nombrecampo')
            ->get();

        return $completados;
    }

    public function camposPendientes(){

        $pendientes = DB::table('campostumba')
            ->join('pendientetumba', function ($join) {
                $join->on('campostumba.idcampo', '=', 'pendientetumba.idcampo')
                    ->where('pendientetumba.idtumba', '=', $this->IdTumba);
            })
            ->orderBy('campostumba.nombrecampo')
            ->get();

        return $pendientes;
    }

}