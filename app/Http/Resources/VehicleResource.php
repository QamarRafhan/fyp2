<?php

namespace App\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'title' => $this->title,
            'images' => $this->images_media ?
                MediaResource::collection($this->images_media) : null,
            'problems' => ProblemResource::collection($this->problems),
        ];
    }
}
