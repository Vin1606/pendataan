<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccessToken
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->query('token') !== env('SECRET_TOKEN')) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
