<?php

namespace App\Http\Resources\API;

use Illuminate\Support\Arr;
use Illuminate\Http\Resources\Json\JsonResource;


class NotificationResource extends JsonResource
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
            'title' => Arr::get($this->data, 'title')  ?  __(Arr::get($this->data, 'title')) : null,
            'data' => $this->data ?? null,
            'created_at' => $this->created_at,
            'is_read' => $this->read(),
        ];
    }
}
