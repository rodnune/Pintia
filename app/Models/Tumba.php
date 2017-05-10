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
    protected $primaryKey = 'IdTumba';


    public function tiposTumbaAsociados(){
        $asociadas = DB::select(DB::raw('SELECT a.IdTipoTumba, a.Denominacion 
								FROM
									TiposTumbas a, TumbaEsDeTipo b
								WHERE
									a.IdTipoTumba = b.IdTipoTumba AND
									b.IdTumba = '. $this->IdTumba ));

									return $asociadas;

    }

    public function tiposTumbaSinAsociar(){

        $no_asociadas = DB::select(DB::raw('SELECT a.IdTipoTumba, a.Denominacion 
								FROM
									TiposTumbas a
								WHERE a.IdTipoTumba  NOT IN
								(
                                    SELECT b.IdTipoTumba 
                                    FROM TumbaEsDeTipo b
                                    WHERE b.IdTumba = ' . $this->IdTumba . ' 
                                  )
								'));

        return $no_asociadas;

    }

    public function cremacionesAsociadas(){
        $asociadas = DB::select(DB::raw('SELECT a.CodigoPropio, a.Presentacion, a.IdCremacion
								FROM
									Cremacion a, CremacionesTumba b
								WHERE
									a.IdCremacion = b.IdCremacion AND
									b.IdTumba = '. $this->IdTumba . '
								ORDER BY a.CodigoPropio'
        ));

        return $asociadas;
    }

    public function cremacionesSinAsociar(){

        $no_asociadas = DB::select(DB::raw('SELECT a.CodigoPropio, a.Presentacion , a.IdCremacion
								FROM
									Cremacion a
								WHERE a.IdCremacion  NOT IN
								(
                                    SELECT b.IdCremacion 
                                    FROM CremacionesTumba b
                                    WHERE b.IdTumba = ' . $this->IdTumba . ' 
                                  )
								'));

        return $no_asociadas;

    }

    public function inhumacionesAsociadas(){
       $asociadas = DB::select(DB::raw('SELECT a.Orientacion, a.Observaciones, a.IdEnterramiento
								FROM
									Inhumacion a, InhumacionesTumba b
								WHERE
									a.IdEnterramiento = b.IdEnterramiento AND
                                    b.IdTumba = '. $this->IdTumba
       ));

       return $asociadas;
    }


    public function inhumacionesSinAsociar(){


        $no_asociadas = DB::select(DB::raw('SELECT a.Orientacion, a.Observaciones , a.IdEnterramiento
								FROM
									Inhumacion a
								WHERE a.IdEnterramiento  NOT IN
								(
                                    SELECT b.IdEnterramiento
                                    FROM InhumacionesTumba b
                                    WHERE b.IdTumba = ' . $this->IdTumba . ' 
                                  )
								'));

        return $no_asociadas;

    }

    public function localizacion()
    {
       $localizacion = DB::table('localizacion')
        ->join('tumba', function ($join) {
            $join->on('localizacion.idlocalizacion', '=', 'tumba.localizacion')
                ->where('tumba.idtumba', '=', $this->IdTumba);
        })
        ->get();

        /*$localizacion = DB::select(DB::raw('SELECT a.IdLocalizacion, a.SiglaZona, a.SectorTrama, a.SectorSubtrama, a.Notas
								FROM
									Localizacion a, Tumba b
								WHERE
									a.IdLocalizacion = b.Localizacion AND
									b.IdTumba = ' . $this->IdTumba

        ));*/

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


       public function ue(){
           $ue = DB::table('unidadestratigrafica')
               ->join('tumba', function ($join) {
                   $join->on('unidadestratigrafica.ue', '=', 'tumba.ue')
                       ->where('tumba.idtumba', '=', $this->IdTumba);
               })
               ->get();

           return $ue;
       }

       public function ueNoAsociadas(){
         $no_asociadas =  DB::select(DB::raw(
               'SELECT UE FROM UnidadEstratigrafica ORDER BY UE ASC'
           ));

        return  $no_asociadas;
       }

}