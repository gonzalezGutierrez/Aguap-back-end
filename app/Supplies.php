<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    protected $table = 'supplies';
    protected $primaryKey = 'id';

    protected $fillable = [
        'consumibles','id_proveedores','cantidad', 
    ];

    
}
