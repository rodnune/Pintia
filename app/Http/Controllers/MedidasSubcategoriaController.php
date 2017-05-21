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
use App\Models\Subcategoria;
use Validator;

class MedidasSubcategoriaController extends \App\Http\Controllers\Controller
{

    public function gestionar_subcategoria(Request $request)
    {


        $subcategoria = $request->input('subcategoria');
        $categoria = $request->input('categoria');



        $validator = Validator::make($request->all(), [
            'subcategoria' => 'required|string',
            'categoria' => 'required|exists:categoria,idcat'
        ]);

        if ($validator->fails()) {
            return redirect('/categoria/' . $categoria)->withErrors($validator);
        }


        if ($request->submit == 'Agregar') {
            DB::table('subcategoria')->insert(['idcat' => $categoria,
                'denominacion' => $subcategoria]);

            return redirect('/categoria/' . $categoria);


        }

        if($request->submit == 'Modificar'){

                $denominacion = $request->input('denominacion');

            $validator = Validator::make($request->all(), [
                'denominacion' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect('/subcategoria/' . $subcategoria)->withErrors($validator);
            }

            DB::table('subcategoria')
                ->where('idsubcat','=', $subcategoria)
                ->where('idcat','=', $categoria)
                ->update(['denominacion' => $denominacion]);

            return redirect('/subcategoria/' . $subcategoria);
        }

        if($request->submit == 'Borrar'){
            DB::table('subcategoria')
                ->where('idsubcat','=', $subcategoria)
                ->where('idcat','=', $categoria)
                ->delete();

            return redirect('/categoria/' . $categoria);


        }
    }

        public function get_subcategoria($id){


        $subcategoria = Subcategoria::find($id);


        $categoria = DB::table('categoria')->where('IdCat','=',strval($subcategoria->IdCat))->first();
        $asociadas = $subcategoria->medidasAsociadas();
        $no_asociadas = $subcategoria->medidasNoAsociadas();



        return view('gestion.medidas_categoria.layout_subcategoria',['subcategoria' => $subcategoria,
        'categoria' => $categoria,'asociadas' => $asociadas , 'no_asociadas' => $no_asociadas]);
    }


    public function gestionar_medida(Request $request){

        $medida = $request->input('medida');
        $subcat = $request->input('subcat');
        $categoria = $request->input('cat');



        $validator = Validator::make($request->all(), [
            'medida' => 'required|exists:medidas,siglasmedida',
            'subcat' => 'required|exists:subcategoria,idsubcat'
        ]);

        if ($validator->fails()) {
            return redirect('/subcategoria/' . $subcat)->withErrors($validator);
        }

        if($request->submit == 'Asociar'){

            DB::table('medidassubcategoria')->insert(['idcat' => $categoria,
                'idsubcat' => $subcat , 'siglasmedida' => $medida]);

            return redirect('/subcategoria/' . $subcat);


        }

        if($request->submit == 'Eliminar'){
            DB::table('medidassubcategoria')
                ->where('idsubcat','=', $subcat)
                ->where('idcat','=', $categoria)
                ->where('siglasmedida','=',$medida)
                ->delete();

            return redirect('/subcategoria/' . $subcat);
        }


    }






}