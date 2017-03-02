<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 09/02/2017
 * Time: 10:14
 */

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{
    protected $table = 'fichaobjeto';
    protected $primaryKey = 'Ref';

    public function phone()
    {
        return $this->hasOne('App\Models\NotasObjeto');
    }
}