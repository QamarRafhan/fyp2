<?php

namespace App\Http\Resources\API;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OperatorLogoResource extends JsonResource
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
            'logo' => isset($this->profile) && isset($this->profile->logo) ?
                MediaResource::collection($this->profile->logo) : null,
        ];
    }
}
