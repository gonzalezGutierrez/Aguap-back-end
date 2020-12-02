<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CatServicio extends Model
{

    protected $table = 'cat_servicios';
    protected $primaryKey =  'idServicio';

    public function scopeGetServicios($query,$status) {
        $today = Carbon::today();
        return $query->tblCostoServicios()
            ->where('cat_servicios.eliminado',$status)
            ->whereDate('tbl_costo_tipo_servicios.fechaExpiracion','<=',$today)
            ->groupBy('cat_servicios.idServicio')
            ->getAttributes();
    }

    public function scopeTblCostoServicios($query) {
        return $query->join('tbl_costo_tipo_servicios','cat_servicios.idServicio','tbl_costo_tipo_servicios.idServicio');
    }

    public function scopeGetAttributes($query) {
        return $query->select(
            'cat_servicios.idServicio',
            'cat_servicios.descripcion',
            'tbl_costo_tipo_servicios.costo'
        );
    }
}
