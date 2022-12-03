<?php

namespace App\Http\Resources\Hobby;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class HobbyCollection extends ResourceCollection
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
                'title' => (string) $data->title,
                'description' => (string) $data->description,
            ];
        });
    }
}
