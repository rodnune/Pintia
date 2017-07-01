<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 09/02/2017
 * Time: 10:14
 */

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Multimedia extends Model
{
    protected $table = 'almacenmultimedia';
    protected $primaryKey = 'idmutimedia';

}