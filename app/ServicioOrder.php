<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ServicioOrder extends Model
{
    protected $table = 'tbl_servicio_ordenes';
    protected $primaryKey = 'idServicioOrden';

    public function scopeGetServiciosByOrderId($query , $idOrden) {
        $today = Carbon::today();
        return $query->tblServicios()
            ->tblCostoServicios()
            ->whereDate('tbl_costo_tipo_servicios.fechaExpiracion','<=',$today)
            ->groupBy('cat_servicios.idServicio')
            ->where('tbl_servicio_ordenes.idOrden',$idOrden)
            ->getAttributes();
    }

    public function scopeTblServicios($query) {
        return $query->join('cat_servicios','tbl_servicio_ordenes.idServicio','cat_servicios.idServicio');
    }

    public function scopeTblCostoServicios($query) {
        return $query->join('tbl_costo_tipo_servicios','cat_servicios.idServicio','tbl_costo_tipo_servicios.idServicio');
    }
    public function scopeGetAttributes($query) {
        return $query->select(
            'cat_servicios.idServicio',
            'cat_servicios.descripcion',
            'tbl_costo_tipo_servicios.costo',
            'tbl_servicio_ordenes.subtotal',
            'tbl_servicio_ordenes.cantidad'
        );
    }



}
