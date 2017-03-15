<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 02/03/2017
 * Time: 11:30
 */

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
        protected $table = 'categoria';
        protected $primaryKey = 'IdCat';
        public $timestamps = false;



}