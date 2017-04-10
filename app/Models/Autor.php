<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 10/04/2017
 * Time: 18:35
 */

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Autor extends Model
{

    protected $table = 'autor';
    protected $primaryKey = 'IdAutor';
    public $timestamps = false;

}