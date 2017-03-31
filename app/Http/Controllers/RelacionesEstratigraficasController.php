<?php

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class RelacionesEstratigraficasController extends \App\Http\Controllers\Controller

{

    public function index(){

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
            'relacionada' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('ud_estratigrafica_relaciones/'.$actual)->withErrors($validator);
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

        return redirect('ud_estratigrafica_relaciones/'.$actual);
    }

    public function eliminarAsociacionUE(Request $request)
    {
        $id = $request -> input('id_relacion');


        $relacion = DB::table('relacionesestratigraficas')->where('IdRelacion', '=', $id)->get();

        DB::table('relacionesestratigraficas')
            ->where('UE', '=', $relacion[0]->RelacionadaConUE)
            ->where('RelacionadaConUE','=',$relacion[0]->UE)
            ->delete();

        DB::table('relacionesestratigraficas')->where('IdRelacion', '=', $id)->delete();



        return redirect('ud_estratigrafica_relaciones/'.$relacion[0]->UE);



    }

    public  function insertRelacion($actual,$relacionada,$relacionAB, $relacionBA){
        /**
         * No es posible hacer la insercion en conjunto
         */
        DB::table('relacionesestratigraficas')->insert(
            ['UE' => $actual, 'RelacionadaConUE' => $relacionada,'TipoRelacion' => $relacionAB]


        );

        DB::table('relacionesestratigraficas')->insert(

            ['UE' => $relacionada, 'RelacionadaConUE' => $actual,'TipoRelacion' => $relacionBA]
        );


    }

}
