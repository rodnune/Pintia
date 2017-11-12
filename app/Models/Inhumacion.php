<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Inhumacion extends Model
{

    protected $table = 'inhumacion';
    protected $primaryKey = 'IdEnterramiento';
    public $timestamps = false;


    public static function getInhumaciones(){

        $inhumaciones = Inhumacion::leftJoin('site_user', function ($join) {
            $join->on('inhumacion.user_id', '=', 'site_user.user_id')
                ->select('inhumacion.*','site_user.admin_level')
                ->orderBy('tumba.identerramiento');

        })
            ->get();

        return $inhumaciones;

    }

    public function registro(){
        $registro = DB::table('registro')
            ->where('IdEnterramiento','=',$this->IdEnterramiento)
            ->select('registro.NumControl')
            ->first();

        return $registro;

    }


    public function admin_level(){

        if(is_null($this->user_id)){
                        return 1;
            }else{
                 $admin_level = User::find($this->user_id)->admin_level;

                 return $admin_level;    
            }
    }
}