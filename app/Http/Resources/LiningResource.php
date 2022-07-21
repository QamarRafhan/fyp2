<?php

namespace App\Http\Resources;

use App\Http\Resources\ColorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LiningResource extends JsonResource
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
            'images' => $this->images_media ?
                MediaResource::collection($this->images_media) : null,
            'colors' =>  ColorResource::collection($this->colors)
        ];
    }
}
