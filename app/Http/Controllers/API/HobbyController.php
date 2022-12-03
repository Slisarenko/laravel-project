<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetAllRequest;
use App\Http\Requests\User\GetRequest;
use App\Http\Requests\Hobby\GetRequest as GetHobbyRequest;
use App\Http\Resources\Hobby\HobbyResource;
use App\Http\Resources\StatusResource;
use App\Services\HobbyService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HobbyController extends Controller
{
    private HobbyService $hobbyService;

    public function __construct(HobbyService $hobbyService)
    {
        $this->hobbyService = $hobbyService;
    }

    public function find(GetHobbyRequest $request): HobbyResource
    {
        $hobby = $this->hobbyService->find($request);

        return HobbyResource::make($hobby);
    }

    public function getByUser(GetRequest $request): AnonymousResourceCollection
    {
        $hobbies = $this->hobbyService->getAllByUser($request);

        return HobbyResource::collection($hobbies);
    }

    public function get(GetAllRequest $request): AnonymousResourceCollection
    {
        $hobbies = $this->hobbyService->getAll();

        return HobbyResource::collection($hobbies);
    }

    public function edit(GetHobbyRequest $request): HobbyResource
    {
        $hobby = $this->hobbyService->edit($request);

        return HobbyResource::make($hobby);
    }

    public function delete(GetHobbyRequest $request): StatusResource
    {
        $status = $this->hobbyService->delete($request);

        return StatusResource::make($status);
    }
}
