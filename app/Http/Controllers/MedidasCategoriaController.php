<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 30/03/2017
 * Time: 23:53
 */

namespace app\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Validator;

class MedidasCategoriaController extends \App\Http\Controllers\Controller
{

    public function get_medidas(){

        $medidas = DB::table('medidas')->orderBy('siglasmedida')->get();

        return view('gestion.medidas_categoria.layout_medidas',['medidas' => $medidas]);
    }


    public function gestionar_medida(Request $request)
    {


        if ($request->submit == 'Agregar') {
        $siglas = $request->input('new_siglas');
        $denominacion = $request->input('new_denominacion');
        $uds = $request->input('new_unidades');

        $validator = Validator::make($request->all(), [
            'new_siglas' => 'required|string|unique:medidas,siglasmedida',
            'new_denominacion' => 'required|string',
            'new_unidades' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect('/gestion_medidas')->withErrors($validator);
        }

        DB::table('medidas')->insert(['siglasmedida' => $siglas, 'denominacion' => $denominacion,
            'unidades' => $uds]);

        return redirect('/gestion_medidas');
    }

        if ($request->submit == 'Modificar') {
            $medida = $request->input('medida');
            $siglas = $request->input('update_siglas');
            $denominacion = $request->input('update_denominacion');
            $uds = $request->input('update_unidades');

            $validator = Validator::make($request->all(), [
                'update_siglas' => 'string',
                'new_denominacion' => 'string',
                'new_unidades' => 'string'
            ]);

            if ($validator->fails()) {
                return redirect('/gestion_medidas')->withErrors($validator);
            }

            DB::table('medidas')->where('siglasmedida','=', $medida)->update(['siglasmedida' => $siglas,
                'denominacion' => $denominacion, 'unidades' => $uds]);


            return redirect('/gestion_medidas');
        }

        if($request->submit == 'Borrar'){
            $medida = $request->input('medida');

            $validator = Validator::make($request->all(), [
                'medida' => 'exists:medidas,siglasmedida',

            ]);

            if ($validator->fails()) {
                return redirect('/gestion_medidas')->withErrors($validator);
            }


            DB::table('medidas')
                ->where('siglasmedida','=', $medida)
                ->delete();

            return redirect('/gestion_medidas');


        }


    }

                public function get_medida($id){

                  $medida =  DB::table('medidas')->where('siglasmedida','=',$id)->get();

                  return $medida;

        }


        public function get_categorias(){

                    $categorias = DB::table('categoria')->orderBy('denominacion')->get();

                return view('gestion.medidas_categoria.layout_categorias',['categorias' => $categorias]);

        }

        public function gestionar_categoria(Request $request){

            if($request->submit == 'Agregar') {
                $categoria = $request->input('categoria');

                $validator = Validator::make($request->all(), [
                    'categoria' => 'unique:categoria,denominacion',

                ]);

                if ($validator->fails()) {
                    return redirect('/gestion_categorias')->withErrors($validator);
                }

                DB::table('categoria')->insert(['denominacion' => $categoria]);

                return redirect('/gestion_categorias');

            }

            if($request->submit == 'Modificar') {
                $idcat = $request->input('id');
                $denominacion = $request->input('denominacion');

                $validator = Validator::make($request->all(), [
                    'id' => 'exists:categoria,idcat',
                    'denominacion' => 'unique:categoria,denominacion'

                ]);

                if ($validator->fails()) {
                    return redirect('/categoria/'.$idcat)->withErrors($validator);
                }

                DB::table('categoria')->where('idcat','=',$idcat)->update(['denominacion' => $denominacion]);

                return redirect('/categoria/'.$idcat);

            }

            if($request->submit == 'Borrar') {
                $idcat = $request->input('id');

                $validator = Validator::make($request->all(), [
                    'id' => 'exists:categoria,idcat'

                ]);

                if ($validator->fails()) {
                    return redirect('/categoria/'.$idcat)->withErrors($validator);
                }

                DB::table('categoria')
                    ->where('idcat','=',$idcat)
                    ->delete();

                return redirect('/gestion_categorias');

            }

        }


        public function get_categoria($id){

            $categoria = Categoria::find($id);

            $asociadas    = $categoria->medidasAsociadas();
            $no_asociadas = $categoria->medidasNoAsociadas();



            return view('gestion.medidas_categoria.layout_categoria',['categoria' => $categoria,'asociadas' => $asociadas,
            'no_asociadas' => $no_asociadas]);
        }


        public function asociar_medida(){

        }





}