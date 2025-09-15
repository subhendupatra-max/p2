<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use App\Traits\NotificationTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileCollection extends JsonResource
{
    use CommonFunction;
    use NotificationTrait;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'user_type' => $this->user_type == 2 ? 'Customer' : 'Marchant',
            'is_verified' => $this->is_verified,
            'profile_image' => $this->image_path,
            'phone_code' => $this->phone_code,
            'country' => $this->country_id ? getCountryById($this->country_id) : null,
            'state' => $this->state_id ? getStateById($this->state_id) : null,
            'city' => $this->city_id ? getCityById($this->city_id) : null,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'device_type' => $this->device_type == 1 ? 'Android' : 'IOS',
            'business' => BusinessCollection::collection($this->businesses),
            'store' => StoreCollection::collection($this->stores),
            'since' => $this->created_at
        ];
    }
}
