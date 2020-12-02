<?php

namespace App\Http\Resources\Api\V1\Resources\Ubications;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UbicationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return UbicationResource::collection($this);
    }
}
