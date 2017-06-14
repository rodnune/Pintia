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

}