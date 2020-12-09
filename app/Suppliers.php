<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table ='suppliers';

    protected $fillable = [
        'nombre','correo','telefono','direccion', 
    ];



}
