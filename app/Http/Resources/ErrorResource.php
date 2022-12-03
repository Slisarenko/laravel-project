<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => [],
            'error' => [
                'status' => $this->getCode(),
                'title'  => $this->getMessage(),
                'detail' => $this->getDetail(),
            ],
        ];
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param Request
     * @param  \Illuminate\Http\Response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->getCode());
    }
}
