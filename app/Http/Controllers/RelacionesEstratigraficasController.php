<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Lang;
use Config;

class RelacionesEstratigraficasController extends \App\Http\Controllers\Controller

{

    public function index(){
                $relaciones = DB::table('relacionesestratigraficas')->orderBy('UE')->get();
        return view('catalogo.relaciones_estratigraficas.layout_relaciones',['relaciones' => $relaciones]);
    }

    public function delete(Request $request){

        $ue = $request -> input('ue');
        $relacionada = $request -> input('relacionada');


        $validator = Validator::make($request->all(), [

            'ue' => 'required|exists:unidadestratigrafica,ue',
            'relacionada'  => 'required|exists:unidadestratigrafica,ue',

        ]);


        if ($validator->fails()) {
            return redirect('/ud_estratigrafica/' . $ue .'/relaciones')->withErrors($validator);
        }

                DB::table('relacionesestratigraficas')
                    ->where('UE', '=', $ue)
                    ->where('RelacionadaConUE','=',$relacionada)
                    ->delete();
        /*
         * Eliminamos la relacion en la otra direccion
         */

        DB::table('relacionesestratigraficas')
            ->where('UE', '=', $relacionada)
            ->where('RelacionadaConUE','=',$ue)
            ->delete();

        return redirect('/ud_estratigrafica/' . $ue .'/relaciones')->with('success',Lang::get('relacion_eliminada'));

    }

    public function indexUE($id)
    {
        $ud_estratigrafica = UnidadEstratigrafica::find($id);
        $asociados = $ud_estratigrafica->relacionesEstratigraficas();
        $no_asociados = $ud_estratigrafica->ueSinAsociar();


        return view('catalogo.uds_estratigraficas.layout_relaciones',['ud_estratigrafica' => $ud_estratigrafica,'asociados' => $asociados,'no_asociados' => $no_asociados]);

    }

    public function asociarUE(Request $request)
    {

        $actual = $request->input('actual');
        $relacionada = $request->input('relacionada');
        $tipo = $request->input('tipo');

        $validator = Validator::make($request->all(), [
            'relacionada' => 'required|exists:unidadestratigrafica,ue',
            'actual'      => 'required|exists:unidadestratigrafica,ue',
            'tipo'        => 'in:'  . implode(',', Config::get('enums.relaciones_estratigraficas')),
        ]);

        if ($validator->fails()) {
            return redirect('/ud_estratigrafica/' . $actual .'/relaciones')->withErrors($validator);
        }



        switch ($tipo) {
            case "igual a":
                    self::insertRelacion($actual,$relacionada,$tipo,"se corresponde con");
                break;
            case "se corresponde con":
                    self::insertRelacion($actual,$relacionada,$tipo,"igual a");
                break;
            case "cubre a":
                    self::insertRelacion($actual,$relacionada,$tipo,"cubierta por");
                break;
            case "cubierta por":
                    self::insertRelacion($actual,$relacionada,$tipo,"cubre a");
                break;

            case "rellena a":
                self::insertRelacion($actual,$relacionada,$tipo,"rellena por");
                break;

            case "rellena por":
                self::insertRelacion($actual,$relacionada,$tipo,"rellena a");
                break;

            case "corta a":
                self::insertRelacion($actual,$relacionada,$tipo,"cortada por");
                break;

            case "cortada por":
                self::insertRelacion($actual,$relacionada,$tipo,"corta a");
                break;

            case "se yuxtapone a":
                self::insertRelacion($actual,$relacionada,$tipo,"se le yuxtapone");
                break;

            case "se le yuxtapone":
                self::insertRelacion($actual,$relacionada,$tipo,"se yuxtapone a");
                break;

            case "se apoya en":
                self::insertRelacion($actual,$relacionada,$tipo,"se le apoya");
                break;

            case "se le apoya":
                self::insertRelacion($actual,$relacionada,$tipo,"se apoya en");
                break;

            case "contiene a":
                self::insertRelacion($actual,$relacionada,$tipo,"contenida en");
                break;

            case "contenida en":
                self::insertRelacion($actual,$relacionada,$tipo,"contiene a");
                break;

        }

        return redirect('/ud_estratigrafica/' . $actual .'/relaciones')
            ->with('success','Relacion UE: '.$actual.' '.$tipo.' UE: '.$relacionada.' añadida correctamente' );
    }

    public function eliminarAsociacionUE(Request $request)
    {
        $id_relacion = $request -> input('id_relacion');
        $ue = $request->input('id');

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:unidadestratigrafica,ue',
            'id_relacion'      => 'required|exists:relacionesestratigraficas,idrelacion',
        ]);

        if ($validator->fails()) {
            return redirect('/ud_estratigrafica/' . $ue .'/relaciones')->withErrors($validator);
        }


        $relacion = DB::table('relacionesestratigraficas')->where('IdRelacion', '=', $id_relacion)->get()->first();

        DB::table('relacionesestratigraficas')
            ->where('UE', '=', $relacion->RelacionadaConUE)
            ->where('RelacionadaConUE','=',$relacion->UE)
            ->delete();


        DB::table('relacionesestratigraficas')->where('IdRelacion', '=', $id_relacion)->delete();



        return redirect('ud_estratigrafica/'.$ue.'/relaciones')->with('success',Lang::get('messages.relacion_eliminada'));



    }

    public  function insertRelacion($actual,$relacionada,$relacionAB, $relacionBA){

        DB::table('relacionesestratigraficas')->insert(
            ['UE' => $actual, 'RelacionadaConUE' => $relacionada,'TipoRelacion' => $relacionAB]


        );

        DB::table('relacionesestratigraficas')->insert(

            ['UE' => $relacionada, 'RelacionadaConUE' => $actual,'TipoRelacion' => $relacionBA]
        );


    }

}
