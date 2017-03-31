<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 31/03/2017
 * Time: 12:33
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ComponenteOrganico extends Model
{

    protected $table = 'componentesorganicos';
    protected $primaryKey = 'IdCOrganico';
    public $timestamps = false;


}