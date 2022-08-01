<?php

namespace App\Http\Resources;

use App\Http\Resources\PaymentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'flight' => new FlightResource($this->flight),
            'passengers' => PassengerResource::collection($this->passengers),
            'extra_services' => $this->extra_services,
            'communication_privacy' => $this->communication_privacy,
            'specialDeal' => $this->specialDeal ? new SpecialDealResource($this->specialDeal) : null,
            'voucher' =>  new VoucherResource($this->voucher),
            'payment' =>  new PaymentResource($this->payment),

        ];
    }
}
