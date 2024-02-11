<?php

namespace Sajadsdi\Marketplace\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sajadsdi\LaravelRestResponse\Concerns\RestResponse;


class Authenticated
{
    use RestResponse;

    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @param string ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string ...$guards): mixed
    {
        $guards = empty($guards) ? [] : $guards;

        foreach ($guards as $guard) {
            if (!Auth::guard($guard)->check()) {
                return $this->unauthorizedResponse();
            }
        }

        return $next($request);
    }
}
