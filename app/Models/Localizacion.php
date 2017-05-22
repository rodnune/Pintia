<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 23/05/2017
 * Time: 0:07
 */

namespace app\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Localizacion  extends Model
{
    protected $table = 'localizacion';
    protected $primaryKey = 'idlocalizacion';

}