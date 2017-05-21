<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 02/03/2017
 * Time: 11:30
 */

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subcategoria extends Model
{
    protected $table = 'subcategoria';
    protected $primaryKey = 'idsubcat';
    public $timestamps = false;


    public function medidasAsociadas(){


        $medidas = DB::table('medidas')
            ->join('medidassubcategoria', function ($join) {
                $join->on('medidassubcategoria.siglasmedida', '=', 'medidas.siglasmedida')
                    ->where('medidassubcategoria.idsubcat', '=', $this->IdSubcat);
            })
            ->get();

        return $medidas;
    }


    public function medidasNoAsociadas(){

        $no_asociadas = DB::table('medidas')->whereNotIn('medidas.siglasmedida',function($q){
            $q->select('medidassubcategoria.siglasmedida')->from('medidassubcategoria')
                ->where('medidassubcategoria.idsubcat','=',$this->IdSubcat);
        })->get();



        return $no_asociadas;

    }



}