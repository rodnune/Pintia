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


}