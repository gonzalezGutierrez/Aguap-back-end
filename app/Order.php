<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'tbl_ordenes';
    protected $primaryKey = 'idOrden';

    public function scopeGetOrderByIdCliente($query,$idUsuario) {
        return $query->where('idCliente',$idUsuario)
            ->where('estatus',0);
    }

    public function scopeGetOrder($query,$idOrder) {
        return $query->tblUsuariosRepartidor()
            ->tblUbicacion()
            ->where('tbl_ordenes.idOrden',$idOrder)
            ->getAttributes();
    }

    public function scopeTblUsuariosRepartidor($query) {
        return $query->join('tbl_usuarios','tbl_ordenes.idRepartidor','tbl_usuarios.idUsuario');
    }

    public function scopeTblUbicacion($query) {
        return $query->join('tbl_ubicaciones','tbl_ordenes.idUbicacion','tbl_ubicaciones.idUbicacion');
    }

    public function scopeGetAttributes($query) {
        return $query->select(
            'tbl_ordenes.idOrden',
            'tbl_ordenes.fechaOrden',
            'tbl_ubicaciones.address',
            'tbl_usuarios.name as nombreRepartidor',
            'tbl_usuarios.lastName as apellidoRepartidor'
        );
    }

}
