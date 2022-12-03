<?php

namespace App\Http\Resources\Hobby;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HobbyResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => (integer) $this->id,
            'userId' => (integer) $this->user_id,
            'title' => (string) $this->title,
            'description' => (string) $this->description,
        ];
    }
}
