<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

final class ContactResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'is_favorite' => $this->is_favorite
        ];
    }
}
