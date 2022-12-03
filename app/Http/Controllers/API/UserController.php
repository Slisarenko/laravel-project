<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\DeleteRequest;
use App\Http\Requests\User\GetAllRequest;
use App\Http\Requests\User\GetRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\IdResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(CreateRequest $request): IdResource
    {
        $id = $this->userService->create($request);

        return IdResource::make($id);
    }

    public function update(UpdateRequest $request): IdResource
    {
        $id = $this->userService->update($request);

        return IdResource::make($id);
    }

    public function get(GetRequest $request): JsonResponse|UserResource
    {
        $user = $this->userService->get($request);

        return UserResource::make($user);
    }

    public function delete(DeleteRequest $request): StatusResource
    {
        $status = $this->userService->delete($request);

        return StatusResource::make($status);
    }

    public function getAll(GetAllRequest $request): JsonResponse|UserCollection
    {
        try {
            $users = $this->userService->getAll($request);
        } catch (\Exception $error) {
            return (new ErrorResource($error))->response();
        }

        return UserCollection::make($users);
    }
}
