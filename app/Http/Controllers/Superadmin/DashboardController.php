<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the superadmin dashboard.
     */
    public function index(Request $request)
    {
        $stats = [
            'total_tenants' => Tenant::count(),
            'active_tenants' => Tenant::where('is_active', true)->count(),
            'pending_tenants' => Tenant::where('is_active', false)->count(),
            'total_users' => User::count(),
        ];

        $recentTenants = Tenant::latest()->take(5)->get();

        return view('superadmin.dashboard', compact('stats', 'recentTenants'));
    }
}