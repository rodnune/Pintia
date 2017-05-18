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

class Categoria extends Model
{
        protected $table = 'categoria';
        protected $primaryKey = 'idcat';
        public $timestamps = false;


        public function medidasAsociadas(){

            $medidas = DB::table('medidas')
                ->join('medidascategoria', function ($join) {
                    $join->on('medidascategoria.siglasmedida', '=', 'medidas.siglasmedida')
                        ->where('medidascategoria.idcat', '=', $this->IdCat);
                })
                ->get();

            return $medidas;
        }


        public function medidasNoAsociadas(){

            $no_asociadas = DB::table('medidas')->whereNotIn('medidas.siglasmedida',function($q){
                $q->select('medidascategoria.siglasmedida')->from('medidascategoria')
                    ->where('medidascategoria.idcat','=',$this->IdCat);
            })->get();



            return $no_asociadas;

        }


        public function subcategorias(){

            $subcategorias = DB::table('subcategoria')->where('idcat', '=', $this->IdCat)->get();

            return $subcategorias;

        }


}