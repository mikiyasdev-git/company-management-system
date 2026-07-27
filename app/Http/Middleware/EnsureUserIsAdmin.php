<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\User|null $user */
        $user = $request->user();

       if (! $user || ! $user->isManagerOrAbove()) {
    abort(403, 'Access denied. Admins only.');
}

        return $next($request);
    }
}
