<?php

namespace App\Http\Controllers\API;

use App\Exceptions\AuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\LoginResource;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request): JsonResponse|LoginResource
    {
        try {
            $user = $this->loginService->login($request);
        } catch (AuthException $error) {
            return (new ErrorResource($error))->response();
        }

        return LoginResource::make($user);
    }
}
