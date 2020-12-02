<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubication extends Model{


    protected $table = 'tbl_ubicaciones';
    protected $primaryKey = 'idUbicacion';


    public function scopeGetUbicacionesByIdUsuario($query,$status,$idUsuario) {
        return $query
            ->where('eliminado',$status)
            ->where('idUsuario',$idUsuario)
            ->where('eliminado',0)
            ->getAttributes();
    }

    public function scopeGetAttributes($query) {
        return $query->select(
            'idUbicacion',
            'latitude',
            'longitude',
            'address',
            'is_GPS',
            'created_at'
        );
    }

}
