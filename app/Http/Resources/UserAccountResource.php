<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_account_id' => $this->user_account_id,
            'u_id' => $this->u_id,
            'username' => $this->username,
            'user_info' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
