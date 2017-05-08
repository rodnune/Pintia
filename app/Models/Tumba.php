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


}