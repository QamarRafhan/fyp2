<?php

namespace App\Http\Resources;

use App\Http\Resources\ColorResource;
use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => new ColorResource($this->color),
            'images' => $this->images_media ?
                MediaResource::collection($this->images_media) : null, 
        ];
    }
}
