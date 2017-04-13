<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 13/04/2017
 * Time: 20:16
 */

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Muestra extends Model
{
    protected $table = 'muestras';
    protected $primaryKey = 'NumeroRegistro';
    public $timestamps = false;


    public function tiposMuestrasAsociados(){
        $asociados = DB::select(DB::raw('SELECT 
									a.IdTipoMuestra, a.Denominacion
								FROM 
									TiposMuestra a, MuestraEsDeTipo b
								WHERE 
									a.IdTipoMuestra = b.IdTipoMuestra AND
									b.NumeroRegistro = ' . $this->NumeroRegistro . ' '));

									return $asociados;
    }

    public function tiposMuestraNoAsociados(){

        $no_asociados = DB::select(DB::raw('SELECT a.IdTipoMuestra, a.Denominacion 
								FROM
									TiposMuestra a
								WHERE a.IdTipoMuestra  NOT IN
								(
                                    SELECT b.IdTipoMuestra 
                                    FROM MuestraEsDeTipo b
                                    WHERE b.NumeroRegistro = ' . $this->NumeroRegistro . ' 
                                  )
								'));

        return $no_asociados;
    }
}