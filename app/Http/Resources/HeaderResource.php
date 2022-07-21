<?php

namespace App\Http\Resources;

use App\Http\Resources\HeaderTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HeaderResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'variations' => HeaderTypeResource::collection($this->types), 
        ];

    }
}
