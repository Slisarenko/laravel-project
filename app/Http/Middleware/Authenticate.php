<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class Authenticate extends Middleware
{
    public function handle($request, \Closure $next, ...$guards)
    {
        if (!Auth::user()) {
            $exception = (new ForbiddenException())->setDetail(Lang::get('exception.forbiddenException'));

            return ErrorResource::make($exception);
        }

        return $next($request);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
