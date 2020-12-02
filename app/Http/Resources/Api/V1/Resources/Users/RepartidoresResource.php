<?php

namespace App\Http\Resources\Api\V1\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class RepartidoresResource extends JsonResource
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
            'id'=>$this->idUsuario,
            'attributes'=>[
                'nombre'=>$this->nombreRepartidor.' '.$this->apellidoRepartidor,
                'telefono'=>$this->telefonoRepartidor,
                'fechaRegistro'=>$this->fechaRegistroRepartidor
            ],

        ];
    }
}
