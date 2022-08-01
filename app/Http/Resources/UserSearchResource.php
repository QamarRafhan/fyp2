<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSearchResource extends JsonResource
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
            'user_id' => $this->user_id,
            'from' => new AirportResource($this->fromLocation),
            'to' => new AirportResource($this->toLocation),
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'seats_required' => $this->seats_required,
            'from_radius' => $this->from_radius,
            'to_radius' => $this->to_radius,
            'notify_me' => $this->notify_me,
            'created_at' => $this->created_at,
        ];
    }
}
