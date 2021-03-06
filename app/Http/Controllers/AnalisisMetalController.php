<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 15/06/2017
 * Time: 18:00
 */

namespace app\Http\Controllers;

use App\Models\Objeto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use URL;

class AnalisisMetalController extends \App\Http\Controllers\Controller
{


    public function index(){

        $analisis_metalograficos = DB::table('analisismetalografico')
            ->leftJoin('fichaobjeto', 'analisismetalografico.idanalisis', '=', 'fichaobjeto.idanalisismatalografico')
            ->select('analisismetalografico.IdAnalisis','analisismetalografico.NumeroInventario','fichaobjeto.Ref')
            ->get();



        return view('catalogo.analisis_met.layout_analisis_index',['analisis_metalograficos' => $analisis_metalograficos]);
    }

    public function nuevo($id)
    {
        $objeto = Objeto::find($id);

        if (is_null($objeto->IdAnalisisMatalografico)) {
            return view('catalogo.objetos.layout_new_analisis', ['objeto' => $objeto]);
        } else {

        }
    }



        public function nuevo_analisis(Request $request){

            $ref = $request->input('ref');
            $id_analisis = $request->input('id_analisis');
            $numero = $request->input('numero');


            if($request->has('fe')){
                $fe = $request->input('fe');
            }else{
                $fe = 0;
            }

            if($request->has('ni')){
                $ni = $request->input('ni');
            }else{
                $ni = 0;
            }

            if($request->has('cu')){
                $cu = $request->input('cu');
            }else{
                $cu = 0;
            }

            if($request->has('zn')){
                $zn = $request->input('zn');
            }else{
                $zn = 0;
            }

            if($request->has('as')){
                $as = $request->input('as');
            }else{
                $as = 0;
            }

            if($request->has('ag')){
                $ag = $request->input('ag');
            }else{
                $ag = 0;
            }

            if($request->has('sn')){
                $sn = $request->input('sn');
            }else{
                $sn = 0;
            }

            if($request->has('sb')){
                $sb = $request->input('sb');
            }else{
                $sb = 0;
            }

            if($request->has('au')){
                $au = $request->input('au');
            }else{
                $au = 0;
            }

            if($request->has('pb')){
                $pb = $request->input('pb');
            }else{
                $pb = 0;
            }



            $cronologia = $request->input('cronologia');
            $notas = $request->input('notas');


            $validator = Validator::make($request->all(), [

                'ref' =>         'required|exists:fichaobjeto,ref',
                'id_analisis' => 'required|unique:analisismetalografico,idanalisis',
                'numero'      => 'required|integer',
                'fe'          => 'numeric|min:0',
                'ni'          => 'numeric|min:0',
                'cu'          => 'numeric|min:0',
                'zn'          => 'numeric|min:0',
                'as'          => 'numeric|min:0',
                'ag'          => 'numeric|min:0',
                'sn'          => 'numeric|min:0',
                'sb'          => 'numeric|min:0',
                'au'          => 'numeric|min:0',
                'pb'          => 'numeric|min:0',
                'cronologia'  => 'string',
                'notas'       => 'string'

            ]);




            if ($validator->fails()) {
                return redirect('/analisis_objeto/'.$ref)
                    ->withErrors($validator);
            }



            DB::table('analisismetalografico')->insert(['idanalisis' => $id_analisis,'numeroinventario' => $numero,
            'fe' => $fe,'ni' => $ni,'cu' => $cu,'zn' => $zn,'ars' => $as,'ag' => $ag ,'sn' => $sn,'sb' => $sb,
            'au' => $au,'pb' => $pb, 'cronologia' => $cronologia,'notas' => $notas]);

            DB::table('fichaobjeto')
                ->where('ref','=',$ref)
                ->update(['idanalisismatalografico' => $id_analisis]);

            return redirect('/analisis_metalograficos')->with('success','Analisis metalografico creado correctamente');









        }

        public function gestionar($id){
            $analisis =  DB::table('analisismetalografico')
                ->leftJoin('fichaobjeto', 'analisismetalografico.idanalisis', '=', 'fichaobjeto.idanalisismatalografico')
                ->select('analisismetalografico.*','fichaobjeto.Ref')
                ->where('fichaobjeto.ref','=',$id)
                ->get()
                ->first();


            return view('catalogo.objetos.layout_gestion_analisis',['analisis' => $analisis]);
        }

        public function get($id){

          $analisis =  DB::table('analisismetalografico')
                ->leftJoin('fichaobjeto', 'analisismetalografico.idanalisis', '=', 'fichaobjeto.idanalisismatalografico')
                ->select('analisismetalografico.*','fichaobjeto.Ref')
                ->where('analisismetalografico.IdAnalisis','=',$id)
                ->get()
                ->first();



            return view('catalogo.analisis_met.layout_analisis',['analisis' => $analisis]);
        }

        public function update(Request $request){

            $ref = $request->input('ref');
            $id_analisis = $request->input('id_analisis');
            $numero = $request->input('numero');
            $id_nuevo = $request->input('id_analisis_nuevo');


            if($request->has('fe')){
                $fe = $request->input('fe');
            }else{
                $fe = 0;
            }

            if($request->has('ni')){
                $ni = $request->input('ni');
            }else{
                $ni = 0;
            }

            if($request->has('cu')){
                $cu = $request->input('cu');
            }else{
                $cu = 0;
            }

            if($request->has('zn')){
                $zn = $request->input('zn');
            }else{
                $zn = 0;
            }

            if($request->has('as')){
                $as = $request->input('as');
            }else{
                $as = 0;
            }

            if($request->has('ag')){
                $ag = $request->input('ag');
            }else{
                $ag = 0;
            }

            if($request->has('sn')){
                $sn = $request->input('sn');
            }else{
                $sn = 0;
            }

            if($request->has('sb')){
                $sb = $request->input('sb');
            }else{
                $sb = 0;
            }

            if($request->has('au')){
                $au = $request->input('au');
            }else{
                $au = 0;
            }

            if($request->has('pb')){
                $pb = $request->input('pb');
            }else{
                $pb = 0;
            }



            $cronologia = $request->input('cronologia');
            $notas = $request->input('notas');


            $validator = Validator::make($request->all(), [

                'ref' =>         'required|exists:fichaobjeto,ref',
                'id_analisis' => 'required',
                'id_analisis_nuevo' => 'required|unique:analisismetalografico,idanalisis,'.$id_analisis.',IdAnalisis',
                'numero'      => 'required|integer',
                'fe'          => 'numeric|min:0',
                'ni'          => 'numeric|min:0',
                'cu'          => 'numeric|min:0',
                'zn'          => 'numeric|min:0',
                'as'          => 'numeric|min:0',
                'ag'          => 'numeric|min:0',
                'sn'          => 'numeric|min:0',
                'sb'          => 'numeric|min:0',
                'au'          => 'numeric|min:0',
                'pb'          => 'numeric|min:0',
                'cronologia'  => 'string',
                'notas'       => 'string'

            ]);




            if ($validator->fails()) {
                return redirect('/gestion_analisis/'.$ref)
                    ->withErrors($validator);
            }

            DB::table('analisismetalografico')->where('idanalisis','=',$id_analisis)->update(['idanalisis' => $id_nuevo,'numeroinventario' => $numero,
                'fe' => $fe,'ni' => $ni,'cu' => $cu,'zn' => $zn,'ars' => $as,'ag' => $ag ,'sn' => $sn,'sb' => $sb,
                'au' => $au,'pb' => $pb, 'cronologia' => $cronologia,'notas' => $notas]);


            return redirect('/gestion_analisis/'.$ref)->with('success','Cambios guardados correctamente');

        }


        public function delete(Request $request){

            $id = $request->input('id_analisis');

            $validator = Validator::make($request->all(), [

                'id_analisis' => 'required|exists:analisismetalografico,idanalisis',


            ]);




            if ($validator->fails()) {
                return redirect('/analisis/'.$id)
                    ->withErrors($validator);
            }



            DB::table('analisismetalografico')
                ->where('idanalisis','=',$id)
                ->delete();

            return redirect('/analisis_metalograficos')->with('success','Analisis metalografico borrado correctamente');
        }




    }

