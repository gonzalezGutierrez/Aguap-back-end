<?php

namespace App\Http\Resources\Api\V1\Resources\Services;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->idServicio,
            'attributes'=>[
                'servicio'=>$this->descripcion,
                'costo'=>"$".number_format($this->costo,'2','.',',')
            ]
        ];
    }
}
