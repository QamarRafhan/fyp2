<?php

namespace App\Http\Resources;

use App\Http\Resources\VehicleResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserNameResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RepairingRequestResource extends JsonResource
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
            'description' => $this->description,
            'video_url' => $this->video_url,
            'status' => $this->status,
            'category' => CategoryResource::collection($this->category),
            'vehicle' => VehicleResource::collection($this->vehicle),
            'customer' => UserNameResource::collection($this->customer),
            'mechanic' => UserNameResource::collection($this->mechanic),
        ];
    }




}



