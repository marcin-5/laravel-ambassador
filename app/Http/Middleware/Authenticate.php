<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $request = $request->merge([
            'headers' => ['Authorization' => 'Bearer ' . $jwt]
        ]);


        return $next($request);
    }
}
