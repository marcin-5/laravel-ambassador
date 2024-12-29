<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $jwt = $request->cookie('jwt');
        $request->headers->set('Authorization', 'Bearer ' . $jwt);

        return $next($request);
    }

    /**
     * Redirect to login if the request is not expecting JSON.
     *
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            return route('login');
        }

        return null;
    }
}
