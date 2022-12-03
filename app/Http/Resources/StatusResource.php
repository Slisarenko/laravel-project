<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class StatusResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = [
            'status' => $this->resource,
        ];

        if (static::$wrap) {
            $data = [static::$wrap => $data];
        }

        return $data;
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param Request
     * @param \Illuminate\Http\Response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode($response->getData()->data->status
            ? Response::HTTP_OK
            : Response::HTTP_FORBIDDEN);
    }
}
