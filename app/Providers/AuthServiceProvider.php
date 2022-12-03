<?php

namespace App\Providers;

use App\Exceptions\AuthException;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function boot()
    {
        $this->registerPolicies();

        return Auth::viaRequest('custom-token', function (Request $request) {
            return User::query()->where('api_token', '=', $request->bearerToken())->first();
        });
    }
}
