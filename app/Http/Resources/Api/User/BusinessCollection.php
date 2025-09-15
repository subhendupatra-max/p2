<?php

namespace App\Http\Resources\Api\User;

use App\Http\Resources\Api\Auth\CategoryCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use App\Traits\NotificationTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessCollection extends JsonResource
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
            'category' => new CategoryCollection($this->category),
            'name' => $this->name,
            'abn' => $this->abn,
            'logo' => $this->logo_path,
            'full_address' => $this->full_address,
            'type' => $this->type,
            'country' => $this->country_id ? getCountryById($this->country_id) : null,
            'state' => $this->state_id ? getStateById($this->state_id) : null,
            'city' => $this->city_id ? getCityById($this->city_id) : null,
            'since' => $this->created_at
        ];
    }
}
