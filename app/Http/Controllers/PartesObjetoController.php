<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 02/03/2017
 * Time: 11:24
 */

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;
use Config;
use Carbon\Carbon;
use App\Models\Objeto;
use App\Models\ParteObjeto;
use URL;

class PartesObjetoController extends \App\Http\Controllers\Controller
{

    public function addParte(Request $request){
        $ref = $request->input('ref');
        $parte = $request->input('parte');

        $validator = Validator::make($request->all(), [
            'ref' => 'required|integer|min:0|exists:fichaobjeto,ref',
            'parte' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }

        DB::table('parteobjeto')->insert(['ref' => $ref , 'denominacion' => $parte]);

        return redirect('/objeto/'. $ref.'/clasificacion_partes')->with('success','Parte objeto creada correctamente');


    }


    public function update(Request $request){

        $ref   = $request->input('ref');
        $parte = $request->input('parte');
        $cat = $request->input('cat');
        $subcat = $request->input('subcat');

        $validator = Validator::make($request->all(), [
            'ref'     => 'required|integer|min:0|exists:fichaobjeto,ref',
            'parte'  => 'required|integer|min:0|exists:parteobjeto,idparte',
        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }

        if($cat == 0){
            $cat = null;
        }

        if($subcat == 0){
            $subcat = null;
        }




        DB::table('parteobjeto')
            ->where('ref','=',$ref)
            ->where('idparte','=',$parte)
            ->update(['idcat' => $cat,'idsubcat' => $subcat]);

        return redirect('/objeto/'.$ref.'/parte/'.$parte)->with('success','Cambios guardados correctamente');
    }

    public function get_parte($ref,$id){


        $parte = DB::table('parteobjeto')->where('idparte','=',$id)->get()->first();

        $objeto = Objeto::find($ref);
        $categorias = DB::table('categoria')->get();

        $nota = $objeto->notaSeccion('Clasificacion y Partes');



        return view('catalogo.objetos.layout_parte_objeto',['objeto' => $objeto,'parte' => $parte,
            'categorias' => $categorias,'nota' => $nota]);
    }

    public function delete(Request $request){
            $parte = $request->input('parte');
            $ref = $request->input('ref');


        $validator = Validator::make($request->all(), [
            'parte'  => 'required|integer|min:0|exists:parteobjeto,idparte',
        ]);


        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }


        DB::table('parteobjeto')
            ->where('idparte','=',$parte)
            ->delete();

        return redirect('/objeto/'. $ref.'/clasificacion_partes')->with('success','Parte de objeto eliminada correctamente');
    }

    public function gestion_materiales_parte(Request $request){

        $parte = $request->input('id_parte');
        $ref = $request->input('ref');



        if ($request->submit == 'Asociar'){
                $material = $request->input('asociar');

            $validator = Validator::make($request->all(), [
                'id_parte'   => 'required|integer|min:0|exists:parteobjeto,idparte',
                'asociar' => 'required|exists:materiaprima,idmat'
            ]);

            if ($validator->fails()) {
                return redirect(URL::previous())->withErrors($validator);
            }

            DB::table('materialobjeto')->insert(['idparte' => $parte, 'idmat' => $material]);
            return redirect('/objeto/'.$ref.'/parte/'.$parte.'/material')->with('success','Material asociado al objeto correctamente');
        }

        if ($request->submit == 'Eliminar'){
            $material = $request->input('eliminar');

            $validator = Validator::make($request->all(), [
                'id_parte'   => 'required|integer|min:0|exists:parteobjeto,idparte',
                'eliminar' => 'required|exists:materiaprima,idmat'
            ]);

            if ($validator->fails()) {
                return redirect(URL::previous())->withErrors($validator);
            }

            DB::table('materialobjeto')
                ->where('idparte','=',$parte)
                ->where('idmat','=',$material)
                ->delete();

            return redirect('/objeto/'.$ref.'/parte/'.$parte.'/material')->with('success','Material eliminado del objeto correctamente');
        }






        }


        public function get_medidas_parte_objeto($id){
            $objeto = Objeto::find($id);


            $partes = $objeto->partesObjeto();

            $pendientes = $objeto->camposPendientes()->keyBy('NombreCampo')->only(['MedidasObjeto'])->all();
            $pendiente = collect($pendientes);

            $nota = $objeto->notaSeccion('Medidas Objeto');

            return view('catalogo.objetos.layout_medidas_partes',['objeto' => $objeto,'partes' => $partes,
            'pendientes' => $pendiente,'nota' => $nota]);

        }

        public function get_medida_parte_objeto($ref,$id){

            $objeto = Objeto::find($ref);
            $parte = ParteObjeto::find($id);
            


           $medidas = $objeto->medidasNoAsociadas();

           $asociadas = $objeto->medidasObjeto();



            $nota = $objeto->notaSeccion('Medidas Objeto');


            return view('catalogo.objetos.layout_medidas_parte',['objeto' => $objeto,'parte' => $parte,
                'medidas' => $medidas,'asociadas' => $asociadas,'nota' => $nota]);
        }


        public function gestionar_medidas_parte(Request $request){

            if($request->submit == 'Nuevo'){


                $ref = $request->input('ref');
                $parte = $request->input('parte');
                $cat = $request->input('cat');
                $subcat = $request->input('subcat');
                $medida = $request->input('medida');
                $posible = $request->input('posible');

  

                

                $valor = $request->input('valor');

                $validator = Validator::make($request->all(), [
                    'ref'     => 'required|integer|min:0|exists:fichaobjeto,ref',
                    'parte'   => 'required|integer|min:0|exists:parteobjeto,idparte',
                    'cat'     => 'required|integer|min:0|exists:categoria,idcat',
                    'subcat'  => 'required|integer|min:0|exists:subcategoria,idsubcat',
                    'medida'  => 'required|min:0|exists:medidas,siglasmedida',
                    'posible' => 'in:'. implode(',', Config::get('enums.bool')),
                    'valor'   => 'required|numeric'
                 ]);

            

                if ($validator->fails()) {
                    return redirect(URL::previous())->withErrors($validator);
                }

                    if(DB::table('medidassubcategoria')->where('idsubcat','=',$subcat)->where('idcat','=',$cat)->where('siglasmedida','=',$medida)->exists()){

                    }else{
                        DB::table('medidassubcategoria')->insert(['idcat' => $cat,'idsubcat' => $subcat,
                    'siglasmedida' => $medida]);
                    }
                    
                

                        if(DB::table('medidascategoria')->where('idcat','=',$cat)->where('siglasmedida','=',$medida)->exists()){

                        }else{
                        DB::table('medidascategoria')->insert(['idcat' => $cat,
                    'siglasmedida' => $medida]);
                        }
                


                DB::table('medidasobjeto')->insert(['idcat' => $cat,'idsubcat' => $subcat,
                    'ref' => $ref,'idparte' => $parte,'siglasmedida' => $medida
                    ,'valor' => $valor,'esposible' => $posible]);



                return redirect('/objeto/'.$ref.'/parte/'.$parte.'/medidas')->with('success','Medida añadida a la parte del objeto');



            }

            if($request->submit == 'Eliminar'){
                $ref = $request->input('ref');
                $parte = $request->input('parte');
                $medida = $request->input('eliminar');

                $validator = Validator::make($request->all(), [
                    'ref'     => 'required|integer|min:0|exists:fichaobjeto,ref',
                    'parte'   => 'required|integer|min:0|exists:parteobjeto,idparte',
                    'eliminar'  => 'required|min:0|exists:medidas,siglasmedida',



                ]);

                if ($validator->fails()) {
                    return redirect(URL::previous())->withErrors($validator);
                }


                DB::table('medidasobjeto')
                    ->where('idparte','=',$parte)
                    ->where('siglasmedida','=',$medida)
                    ->delete();

                return redirect('/objeto/'.$ref.'/parte/'.$parte.'/medidas')->with('success','Medida eliminada de la parte del objeto');

            }

        }



}