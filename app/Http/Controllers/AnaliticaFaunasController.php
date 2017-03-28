<?php


namespace app\Http\Controllers;

use App\Models\AnaliticaFauna;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class AnaliticaFaunasController extends \App\Http\Controllers\Controller
{

    public function index(){

        $analiticasFaunas = AnaliticaFauna::all();

        return view('catalogo.analiticas_faunas.layout_analiticas',['analiticasFaunas' => $analiticasFaunas]);
    }

    public function get_analitica($id){

        return view('catalogo.analiticas_faunas.update_analitica',['id' => $id]);
    }

    public function create(Request $request){
        $new_analitica = new AnaliticaFauna();
        $descripcion = $request ->input('descripcion');
        $partes_oseas = $request->input('partes_oseas');


        $validator = Validator::make($request->all(), [



            'descripcion' => 'required|unique:analiticafaunas,descripcion',
            'partes_oseas' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/analiticas_faunas/new')
                ->withErrors($validator);
        }

        $new_analitica ->Descripcion = $descripcion;
        $new_analitica ->PartesOseasEspecieEdad = $partes_oseas;

        $new_analitica->save();

        return redirect('/analiticas_faunas');
    }

    public function update(Request $request){
        $id = $request ->input('id');
        $new_descripcion = $request ->input('descripcion');
        $new_partes_oseas = $request->input('partes_oseas');




        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|unique:analiticafaunas,descripcion',
            'partes_oseas' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/analiticas_faunas/'.$id)
                ->withErrors($validator);
        }
        $analitica_fauna = AnaliticaFauna::find($id);
        $analitica_fauna->Descripcion = $new_descripcion;
        $analitica_fauna ->PartesOseasEspecieEdad = $new_partes_oseas;

        $analitica_fauna->save();

        return redirect('/analiticas_faunas');

    }

    public function delete(Request $request){
         $id = $request ->input('id');
        $analitica_fauna = AnaliticaFauna::find($id);
        $analitica_fauna->delete();

        return redirect('/analiticas_faunas');
    }

    public function indexUE($id){
        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $no_asociados = DB::select(DB::raw('SELECT a.IdAnalitica, a.Descripcion, a.PartesOseasEspecieEdad
								FROM
									AnaliticaFaunas a
								WHERE a.IdAnalitica  NOT IN
								(
                                    SELECT b.IdAnalitica
                                    FROM DietasFauna b
                                    WHERE b.UE = ' . $id . ' 
                                  )
								'));


        $asociados = DB::select(DB::raw('SELECT a.IdAnalitica, a.Descripcion, a.PartesOseasEspecieEdad
								FROM
									AnaliticaFaunas a, DietasFauna b
								WHERE
									a.IdAnalitica = b.IdAnalitica AND
									b.UE = ' . $id . '
								ORDER BY a.Descripcion ASC'));


        return view('catalogo.uds_estratigraficas.layout_dietas_fauna', ['ud_estratigrafica' => $ud_estratigrafica, 'asociados' => $asociados, 'no_asociados' => $no_asociados]);

    }

    public function asociarUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_analitica = $request->input('add');
        DB::table('dietasfauna')->insert(['IdAnalitica' => $id_analitica, 'UE' => $id_ue]);

        return redirect('/ud_estratigrafica_dietas/' . $id_ue);
    }

    public function eliminarAsociacionUE(Request $request)
    {
        $id_ue = $request->input('id');
        $id_analitica = $request->input('delete');
 


        /*
         * Doble condicion where
         */
        DB::table('dietasfauna')->where(
            'IdAnalitica', '=', $id_analitica)
            ->where('UE', '=', $id_ue)
            ->delete();

        return redirect('/ud_estratigrafica_dietas/' . $id_ue);
    }



}