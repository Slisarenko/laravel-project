<?php

namespace App\Services;

use App\Exceptions\AuthException;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class LoginService
{
    public string $token;

    public function login(LoginRequest $request): User
    {
        $user = User::query()->whereEmail($request->input('email'))->first();

        if (Hash::check($user->password, $request->input('password'))) {
            throw (new AuthException)
                ->setDetail(Lang::get('exception.authException'));
        }

        $token = Str::random(60);
        $hash = hash('sha256', $token);

        $user->forceFill(['api_token' => $hash])->save();

        return $user;
    }
}
