<?php

namespace App\Http\Resources\Api\V1\Resources\Ubications;

use Illuminate\Http\Resources\Json\JsonResource;

class UbicationResource extends JsonResource
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
            'idUbication'=>$this->idUbicacion,
            'attributes'=>[
                'longitude'=>$this->longitude,
                'latitude'=>$this->latitude,
                'is_GPS'=>$this->is_GPS,
                'address'=>$this->address,
                'fechaRegistro'=>$this->created_at->diffForHumans()
            ]
        ];
    }
}
