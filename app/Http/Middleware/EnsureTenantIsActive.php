<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Multitenancy\Http\Middleware\NeedsTenant;
use Spatie\Multitenancy\Models\Tenant;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantIsActive
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = Tenant::current();

        if ($tenant && ! $tenant->is_active) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Tenant account is suspended.'], 403);
            }
            auth()->logout();
            return redirect()->route('login')->with('error', 'Your organization\'s account is suspended. Please contact support.');
        }

        return $next($request);
    }
}