<?php


namespace app\Http\Controllers;

use App\Models\AnaliticaFauna;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Lang;
use URL;

class AnaliticaFaunasController extends \App\Http\Controllers\Controller
{

    public function index(){

        $analiticasFaunas = AnaliticaFauna::all();

        return view('catalogo.analiticas_faunas.layout_analiticas',['analiticasFaunas' => $analiticasFaunas]);
    }

    public function get_analitica($id){

       $analitica = AnaliticaFauna::find($id);

        return view('catalogo.analiticas_faunas.update_analitica',['analitica' => $analitica]);
    }

    public function create(Request $request){
        $new_analitica = new AnaliticaFauna();
        $descripcion = $request ->input('descripcion');
        $partes_oseas = $request->input('partes_oseas');


        $validator = Validator::make($request->all(), [

            'descripcion' => 'required|string',
            'partes_oseas' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect('/new_analitica')
                ->withErrors($validator);
        }

        $new_analitica ->Descripcion = $descripcion;
        $new_analitica ->PartesOseasEspecieEdad = $partes_oseas;

        $new_analitica->save();

        return redirect('/analiticas_faunas')->with('success','Analitica de faunas creada correctamente');
    }

    public function update(Request $request){
        $id = $request ->input('id');
        $new_descripcion = $request ->input('descripcion');
        $new_partes_oseas = $request->input('partes');




        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:analiticafaunas,idanalitica',
            'descripcion' => 'required',
            'partes' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/analitica_fauna/'.$id)
                ->withErrors($validator);
        }
        $analitica_fauna = AnaliticaFauna::find($id);
        $analitica_fauna->Descripcion = $new_descripcion;
        $analitica_fauna ->PartesOseasEspecieEdad = $new_partes_oseas;

        $analitica_fauna->save();

        return redirect('/analitica_fauna/'.$id)->with('success','Analitica ' .$id. ' modificada con exito');

    }

    public function delete(Request $request){
         $id = $request ->input('id');
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:analiticafaunas,idanalitica',
        ]);

        if ($validator->fails()) {
            return redirect('/analitica_fauna/'.$id)
                ->withErrors($validator);
        }
        $analitica_fauna = AnaliticaFauna::find($id);

        $analitica_fauna->delete();

        return redirect('/analiticas_faunas')->with('success','Analitica: ' .$id. ' ,borrada correctamente');
    }

    public function indexUE($id){
        $ud_estratigrafica = UnidadEstratigrafica::find($id);
           $asociados = $ud_estratigrafica-> analiticasAsociadasUE();
       $no_asociados = $ud_estratigrafica-> analiticasNoAsociadasUE();
        $nota = $ud_estratigrafica->notaSeccion('Dietas Fauna');

        return view('catalogo.uds_estratigraficas.layout_dietas_fauna', ['ud_estratigrafica' => $ud_estratigrafica,
            'asociados' => $asociados, 'no_asociados' => $no_asociados,'nota' => $nota]);

    }

    public function asociarUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_analitica = $request->input('add');

        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:unidadestratigrafica,ue',
            'add'  => 'required|exists:analiticafaunas,idanalitica',

        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }

        DB::table('dietasfauna')->insert(['IdAnalitica' => $id_analitica, 'UE' => $id_ue]);

        return redirect('/ud_estratigrafica/' . $id_ue .'/dietas')
            ->with('success','Dieta fauna asociada correctamente');
    }

    public function eliminarAsociacionUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_analitica = $request->input('delete');

        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:unidadestratigrafica,ue',
            'delete'  => 'required|exists:analiticafaunas,idanalitica',

        ]);

        if ($validator->fails()) {
            return redirect(URL::previous())->withErrors($validator);
        }


        DB::table('dietasfauna')->where(
            'IdAnalitica', '=', $id_analitica)
            ->where('UE', '=', $id_ue)
            ->delete();

        return redirect('/ud_estratigrafica/' . $id_ue .'/dietas')->with('success',Lang::get('messages.asociacion_eliminada'));
    }



}