<?php

namespace App\Http\Resources\Api\V1\Resources\Services;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiciosCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ServicioResource::collection($this);
    }
}
