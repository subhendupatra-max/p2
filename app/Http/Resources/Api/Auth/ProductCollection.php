<?php

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'user_business_id' => $this->user_business_id,
            'store_id' => $this->store_id ?? null,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'mrp' => $this->mrp,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'added_time' => $this->created_at,
            'images' => ProductImageCollection::collection($this->images)
        ];
    }
}
