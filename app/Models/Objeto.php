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
use \App\Models\User;

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

        $completados = DB::table('camposobjeto')->whereNotIn('camposobjeto.idcampo',function($q){
            $q->select('pendienteobjeto.idcampo')->from('pendienteobjeto')->where('pendienteobjeto.ref','=',$this->Ref);
        })
            ->orderBy('camposobjeto.nombrecampo')
            ->get();

        return $completados;
    }

    public function camposPendientes(){

        $pendientes = DB::table('camposobjeto')
            ->join('pendienteobjeto', function ($join) {
                $join->on('camposobjeto.idcampo', '=', 'pendienteobjeto.idcampo')
                    ->where('pendienteobjeto.ref', '=', $this->Ref);
            })
            ->orderBy('camposobjeto.nombrecampo')
            ->get();

        return $pendientes;
    }

    public function notaSeccion($seccion){


        $nota_seccion = DB::table('notasobjeto')
            ->where('ref','=',$this->Ref)
            ->where('seccion','=',$seccion)
            ->get()
            ->first();

        return $nota_seccion;
    }

    public function localizacion(){

        $localizacion =DB::table('localizacion')
            ->where('idlocalizacion','=',$this->Localizacion)
            ->get()
            ->first();

        return $localizacion;


    }

    public function medidasObjeto(){


        $medidas = DB::table('medidas')
            ->join('medidasobjeto', function ($join) {
                $join->on('medidasobjeto.siglasmedida', '=', 'medidas.siglasmedida')
                    ->where('medidasobjeto.ref', '=', $this->Ref);
            })
            ->get();

        return $medidas;


    }

    public function medidasNoAsociadas(){


        $no_asociadas = DB::table('medidas')->whereNotIn('medidas.siglasmedida',function($q){
            $q->select('medidasobjeto.siglasmedida')->from('medidasobjeto')->where('medidasobjeto.ref','=',$this->Ref);
        })
            ->get();


        return $no_asociadas;

    }

    public function materialesObjeto(){


        $materiales = DB::table('materialobjeto')
            ->join('materiaprima', 'materialobjeto.idmat', '=', 'materiaprima.idmat')
            ->whereIn('materialobjeto.idparte',function($q){
                $q->select('parteobjeto.idparte')->from('parteobjeto')->where('parteobjeto.ref','=',$this->Ref);
            })
            ->distinct()->select('materiaprima.Denominacion','materialobjeto.IdMat')

            ->get();

        return $materiales;
    }

    public function registro(){

        $registro = DB::table('registro')
            ->where('Ref','=',$this->Ref)
            ->select('registro.NumControl')
            ->first();

        return $registro;
    }

    public static function getObjetos(){

        $objetos = Objeto::leftJoin('site_user', function ($join) {
            $join->on('fichaobjeto.user_id', '=', 'site_user.user_id')
                ->select('fichaobjeto.*','site_user.admin_level')
                ->orderBy('fichaobjeto.ref');

        })
            ->get();

        return $objetos;

    }

    public static function getObjetosVisibles(){
        $objetos = Objeto::leftJoin('site_user', function ($join) {
            $join->on('fichaobjeto.user_id', '=', 'site_user.user_id')
                ->select('fichaobjeto.*','site_user.admin_level')
                ->orderBy('fichaobjeto.ref');

        })
            ->where('fichaobjeto.visiblecatalogo','=','Si')
            ->get();

            return $objetos;

    }

    public function admin_level(){

            if(is_null($this->user_id)){
                        return 1;
            }else{
                 $admin_level = User::find($this->user_id)->admin_level;

                 return $admin_level;    
            }

    }

    public function lugarObjeto(){

      $lugar = DB::table('lugar')
            ->join('localizacion', function ($join) {
                $join->on('localizacion.siglazona', '=', 'lugar.siglazona')
                    ->where('localizacion.idlocalizacion', '=', $this->Localizacion);
            })
            ->first();

            return $lugar;
    }





}