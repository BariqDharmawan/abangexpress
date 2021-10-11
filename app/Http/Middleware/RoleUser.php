<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleUser
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->check() and auth()->user()->role == $role) {
            return $next($request);
        }
        else {
            abort(403);
        }
    }
}
