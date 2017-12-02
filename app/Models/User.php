<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'site_user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $fillable = [
        'username','password','admin_level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


    public function registrosPendientes(){

        $registros = DB::table('registro')
        ->select(DB::raw('count(*) as registros'))
            ->where('user_id','=',$this->user_id)
            ->get()
            ->first();

            return $registros;
    }


}
