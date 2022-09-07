<?php

namespace Modules\ApplicationAuth\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \Modules\ApplicationAuth\Entities\ApplicationUser
 */
class ApplicationUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified' => $this->hasVerifiedEmail(),
            'locale' => $this->locale,
            'username' => $this->username,
            'avatar' => ($avatar = $this->avatar)
                ? MediaResource::make($avatar)
                : null,
            'images' => $this->images_media ?
                MediaResource::collection($this->images_media) : null,
            'role' => $this->role,
            'rating' => $this->rating,
            'price' => $this->price,
            'allow_notifications' => $this->allow_notifications
        ];
    }
}
