<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the tenant dashboard.
     */
    public function index(Request $request)
    {
        $tenant = \Spatie\Multitenancy\Models\Tenant::current();

        if (! $tenant) {
            return redirect()->route('login')->with('error', 'No active tenant found.');
        }

        $stats = [
            'total_leads' => Lead::count(),
            'leads_this_month' => Lead::whereMonth('created_at', now()->month)->count(),
            'total_exhibitions' => \App\Models\Exhibition::count(),
        ];

        $recentLeads = Lead::latest()->take(5)->get();

        return view('tenant.dashboard', compact('stats', 'recentLeads', 'tenant'));
    }
}