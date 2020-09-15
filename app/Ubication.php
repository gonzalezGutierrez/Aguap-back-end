<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubication extends Model{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUser','latitude','longitude','address','IS_GPS', 
    ];

   

   

}
