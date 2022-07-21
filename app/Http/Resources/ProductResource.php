<?php

namespace App\Http\Resources;

use App\Http\Resources\HeaderResource;
use App\Http\Resources\LiningResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'linings' => LiningResource::collection($this->linings), 
            'variations' => ProductVariationResource::collection($this->variations), 
            'headers' => HeaderResource::collection($this->headers), 
        
        ];

    }
}
