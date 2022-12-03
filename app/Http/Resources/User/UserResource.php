<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Hobby\HobbyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => (integer) $this->id,
            'imageUrl' => (string) $this->image_url,
            'name' => (string) $this->name,
            'email' => (string) $this->email,
            'emailVerifiedAt' => (string) $this->email_verified_at,
            'createdAt' => (string) $this->created_at,
            'updatedAt' => (string) $this->updated_at,
            'hobbies' => HobbyResource::collection($this->hobbies)
        ];
    }
}
