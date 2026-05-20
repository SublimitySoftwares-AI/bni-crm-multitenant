<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSuperadmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->hasRole('superadmin')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Superadmin access required.'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'Access denied. Superadmin privileges required.');
        }

        return $next($request);
    }
}