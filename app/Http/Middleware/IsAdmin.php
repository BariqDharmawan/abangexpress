<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() and auth()->user()->role == 'admin') {
            return $next($request);
        }
        else {
            abort(403);
        }
    }
}
