<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    protected $fillable = [
        'consumibles','id_proveedores','cantidad', 
    ];
}
