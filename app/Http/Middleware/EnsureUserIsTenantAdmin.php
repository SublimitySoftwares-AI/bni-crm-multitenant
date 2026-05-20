<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsTenantAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->hasRole(['superadmin', 'tenant_admin'])) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Tenant admin access required.'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'Access denied. Tenant admin privileges required.');
        }

        return $next($request);
    }
}