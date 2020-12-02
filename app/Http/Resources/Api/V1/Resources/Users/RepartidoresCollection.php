<?php

namespace App\Http\Resources\Api\V1\Resources\Users;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RepartidoresCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return RepartidoresResource::collection($this);
    }
}
