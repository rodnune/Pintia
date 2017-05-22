<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 21/03/2017
 * Time: 11:15
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnidadEstratigrafica extends Model
{
    protected $table = 'unidadestratigrafica';
    protected $primaryKey = 'UE';
    public $timestamps = false;



        public function componentesOrganicosNoAsociados(){
            $no_asociados =  DB::select(DB::raw('SELECT a.IdCOrganico, a.Denominacion 
								FROM
									ComponentesOrganicos a
								WHERE a.IdCOrganico  NOT IN
								(
                                    SELECT b.IdCOrganico
                                    FROM COrganicosUE b
                                    WHERE b.UE = '.$this->UE.' 
                                  )
								'));

            return $no_asociados;
        }


    public function componentesOrganicosAsociados(){

        $asociados =  DB::select(DB::raw('SELECT a.IdCOrganico, a.Denominacion 
								FROM
									ComponentesOrganicos a, COrganicosUE b
								WHERE
									a.IdCOrganico = b.IdCOrganico AND
									b.UE = '. $this->UE .'
								ORDER BY Denominacion ASC'));

        return $asociados;
    }

    public function componentesGeologicosNoAsociados(){
        $no_asociados =  DB::select(DB::raw('SELECT a.IdCGeologico, a.Denominacion 
								FROM
									ComponentesGeologicos a
								WHERE a.IdCGeologico  NOT IN
								(
                                    SELECT b.IdCgeologico 
                                    FROM CGeologicosUE b
                                    WHERE b.UE = '.$this->UE.' 
                                  )
								'));

        return $no_asociados;
    }

public function componentesGeologicosAsociados(){

    $asociados =  DB::select(DB::raw('SELECT a.IdCGeologico, a.Denominacion 
								FROM
									ComponentesGeologicos a, CGeologicosUE b
								WHERE
									a.IdCGeologico = b.IdCGeologico AND
									b.UE = '. $this->UE.'
								ORDER BY Denominacion ASC'));

    return $asociados;
}





public function componentesArtificialesNoAsociados(){
    $no_asociados = DB::select(DB::raw('SELECT a.IdCArtificial, a.Denominacion 
								FROM
									ComponentesArtificiales a
								WHERE a.IdCArtificial  NOT IN
								(
                                    SELECT b.IdCArtificial 
                                    FROM CArtificialesUE b
                                    WHERE b.UE = ' . $this->UE . ' 
                                  )
								'));

    return $no_asociados;

}

public function componentesArtificialesAsociados(){
    $asociados = DB::select(DB::raw('SELECT a.IdCArtificial, a.Denominacion 
								FROM
									ComponentesArtificiales a, CArtificialesUE b
								WHERE
									a.IdCArtificial = b.IdCArtificial AND
									b.UE = ' . $this->UE . '
								ORDER BY Denominacion ASC'));

    return $asociados;
}



public function superficiesAsociadas(){

    $asociados = DB::select(DB::raw('SELECT a.IdSuperficie, a.Denominacion 
								FROM
									Superficies a, SuperficiesUE b
								WHERE
									a.IdSuperficie = b.IdSuperficie AND
									b.UE = ' . $this->UE . '
								ORDER BY Denominacion ASC'));

    return $asociados;
}

public function superficiesNoAsociadas(){
    $no_asociados = DB::select(DB::raw('SELECT a.IdSuperficie, a.Denominacion 
								FROM
									Superficies a
								WHERE a.IdSuperficie  NOT IN
								(
                                    SELECT b.IdSuperficie 
                                    FROM SuperficiesUE b
                                    WHERE b.UE = ' . $this->UE . ' 
                                  )
								'));

    return $no_asociados;

}





    public function analiticasNoAsociadasUE()
    {

        $no_asociados = DB::select(DB::raw('SELECT a.IdAnalitica, a.Descripcion, a.PartesOseasEspecieEdad
								FROM
									AnaliticaFaunas a
								WHERE a.IdAnalitica  NOT IN
								(
                                    SELECT b.IdAnalitica
                                    FROM DietasFauna b
                                    WHERE b.UE = ' . $this->UE . ' 
                                  )
								'));

        return $no_asociados;
    }

    public function analiticasAsociadasUE(){

$asociados = DB::select(DB::raw('SELECT a.IdAnalitica, a.Descripcion, a.PartesOseasEspecieEdad
								FROM
									AnaliticaFaunas a, DietasFauna b
								WHERE
									a.IdAnalitica = b.IdAnalitica AND
									b.UE = ' . $this->UE . '
								ORDER BY a.Descripcion ASC'));

return $asociados;

}

public function artefactosAsociados(){

    $asociados = DB::select(DB::raw('SELECT a.IdFosil, a.Denominacion 
								FROM
									Fosiles a, FosilesUE b
								WHERE
									a.IdFosil = b.IdFosil AND
									b.UE = ' . $this->UE . '
								ORDER BY Denominacion ASC'));

    return $asociados;
}

public function artefactosNoAsociados(){
    $no_asociados = DB::select(DB::raw('SELECT a.IdFosil, a.Denominacion 
								FROM
									Fosiles a
								WHERE a.IdFosil  NOT IN
								(
                                    SELECT b.IdFosil
                                    FROM FosilesUE b
                                    WHERE b.UE = ' . $this->UE . ' 
                                  )
								'));

    return $no_asociados;

}

public function localizacion(){



    $localizacion = DB::table('localizacion')
        ->join('unidadestratigrafica', function ($join) {
            $join->on('unidadestratigrafica.idlocalizacion', '=', 'localizacion.idlocalizacion')
                ->where('unidadestratigrafica.ue', '=', $this->UE);
        })
        ->get();


    return $localizacion;
}




public function ueSinAsociar(){
    $no_asociados = DB::select(DB::raw('SELECT a.UE
								FROM 
								UnidadEstratigrafica a
								WHERE a.UE  NOT IN
								(
                                    SELECT b.RelacionadaConUE
                                    FROM RelacionesEstratigraficas b
                                    WHERE b.UE = ' . $this->UE . ' 
                                  )
								'));

    return $no_asociados;

}


public function relacionesEstratigraficas(){
    $asociados = DB::select(DB::raw('SELECT DISTINCT a.IdRelacion,a.UE,a.TipoRelacion, a.RelacionadaConUE 
								FROM
									RelacionesEstratigraficas a, UnidadEstratigrafica b
								WHERE
									a.UE = b.UE AND
									b.UE = ' . $this->UE . '  OR a.RelacionadaConUE = ' . $this->UE .' '));

    return $asociados;
}


public function matrixHarrisAsociar(){
    /**
     * Distinct para que solo saque una relacion en una sola direccion
     */
    $ud_asociadas = DB::select(DB::raw('SELECT DISTINCT a.RelacionadaConUE 
								FROM
									RelacionesEstratigraficas a, UnidadEstratigrafica b
								WHERE a.RelacionadaConUE  NOT IN
								(
                                    SELECT b.RelacionadaConUE
                                    FROM MatrixHarris b
                                    WHERE b.UE = ' . $this->UE . '
                                    )
    
                                  '));

    return $ud_asociadas;
}

public function matrixHarris(){
    $matrix_harris = DB::select(DB::raw('SELECT IdElementoHarris, RelacionadaConUE, PosX, PosY, PosZ
								FROM
									MatrixHarris
								WHERE
									UE = ' . $this->UE . ' 
                                ORDER BY RelacionadaConUE  '));

    return $matrix_harris;

}

public function muestrasAsociadas(){
    $asociadas =  DB::select(DB::raw('SELECT a.NumeroRegistro, a.Notas 
								FROM
									Muestras a, MuestrasUE b
								WHERE
									a.NumeroRegistro = b.NumeroRegistro AND
									b.UE = '. $this->UE .'
								'));

    return $asociadas;

}

public function muestrasNoAsociadas(){
    $no_asociadas = DB::select(DB::raw('SELECT a.NumeroRegistro, a.Notas 
								FROM
									Muestras a
								WHERE a.NumeroRegistro  NOT IN
								(
                                    SELECT b.NumeroRegistro 
                                    FROM MuestrasUE b
                                    WHERE b.UE = ' . $this->UE . ' 
                                  )
								'));

    return $no_asociadas;
}














}