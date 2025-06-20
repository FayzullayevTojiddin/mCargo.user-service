<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $providedKey = $request->header('X-Service-Key');
        $expectedKey = config('services.user_service.secret');

        if (! $providedKey || $providedKey !== $expectedKey) {
            abort(403, 'Unauthorized service access');
        }

        return $next($request);
    }
}
