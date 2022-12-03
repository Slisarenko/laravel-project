<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return Collection
     */
    public function toArray($request): Collection
    {
        return $this->collection->transform(function ($data) {
            return [
                'id' => (integer) $data->id,
                'name' => (string) $data->name,
                'email' => (string) $data->email,
                'emailVerifiedAt' => (string) $data->email_verified_at,
                'createdAt' => (string) $data->created_at,
                'updatedAt' => (string) $data->updated_at,
            ];
        });
    }
}
