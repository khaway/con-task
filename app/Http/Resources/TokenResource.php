<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

final class TokenResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'access_token' => $this->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }
}
