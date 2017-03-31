<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 31/03/2017
 * Time: 10:54
 */

namespace app\Http\Controllers;
use App\Models\UnidadEstratigrafica;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class LocalizacionController extends \App\Http\Controllers\Controller
{
    public function indexUE($id){

        $localizaciones = DB::table('localizacion')->get();



        $ud_estratigrafica = UnidadEstratigrafica::find($id);

        $localizacion = $ud_estratigrafica->localizacion();


        return view('catalogo.uds_estratigraficas.layout_localizacion',['ud_estratigrafica' => $ud_estratigrafica, 'localizacion' => $localizacion[0], 'localizaciones' => $localizaciones]);


    }

    public function asociarUE(Request $request){
        $id_ue = $request->input('id');
        $localizacion = $request->input('localizacion');

        UnidadEstratigrafica::where('UE',$id_ue)->update(['IdLocalizacion' => $localizacion]);

        return redirect('/ud_estratigrafica_localizacion/'.$id_ue);
    }

}