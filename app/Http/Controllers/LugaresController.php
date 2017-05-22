<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 31/03/2017
 * Time: 10:54
 */

namespace app\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;


class LugaresController extends \App\Http\Controllers\Controller
{

 public function get_lugares(){

      $lugares = DB::table('lugar')->get();

     return view('gestion.geografia.layout_lugares',['lugares' => $lugares]);
 }


 public function get($id){

     $lugar = DB::table('lugar')->where('siglazona','=',$id)->get();

     return $lugar;
 }


 public function gestion_lugares(Request $request){

                $id = $request->input('id_lugar');
                $municipio  = $request->input('municipio');
                $toponimo   = $request->input('toponimo');
                $parcela    = $request->input('parcela');


   if($request->submit == 'Agregar'){


            $siglazona = $request->input('siglazona');


       $validator = Validator::make($request->all(), [

           'municipio' => 'required|string',
           'siglazona'  => 'required|unique:lugar,siglazona'

       ]);


       if ($validator->fails()) {
           return redirect('/gestion_lugares')
               ->withErrors($validator);
       }


       DB::table('lugar')->insert(['siglazona' => $siglazona,
           'municipio' => $municipio,'toponimo' => $toponimo, 'parcela' => $parcela]);

       return redirect('/gestion_lugares');

   }



        if($request->submit == 'Borrar'){

            $validator = Validator::make($request->all(), [


                'id_lugar'  => 'required|exists:lugar,siglazona',

            ]);



            if ($validator->fails()) {
                return redirect('/gestion_lugares')
                    ->withErrors($validator);
            }

            DB::table('lugar')
                ->where('siglazona','=',$id)
                ->delete();

            return redirect('/gestion_lugares');


        }




     if($request->submit == 'Modificar'){

         $validator = Validator::make($request->all(), [


             'municipio' => 'required|string',
             'toponimo'  => 'string',
             'parcela'   => 'integer|min:0'
         ]);

         if ($validator->fails()) {
             return redirect('/gestion_lugares')
                 ->withErrors($validator);
         }


         DB::table('lugar')->where('siglazona','=',$id)->update([
             'municipio' => $municipio , 'toponimo' => $toponimo , 'parcela' => $parcela]);

         return redirect('/gestion_lugares');


     }




 }


}