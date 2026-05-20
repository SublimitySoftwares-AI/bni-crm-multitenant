<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TenantController extends Controller
{
    /**
     * Display a listing of tenants.
     */
    public function index(): View
    {
        $tenants = Tenant::withCount('users')->latest()->paginate(20);
        return view('superadmin.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new tenant.
     */
    public function create(): View
    {
        return view('superadmin.tenants.create');
    }

    /**
     * Store a newly created tenant.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tenants,name'],
            'domain' => ['nullable', 'string', 'max:255', 'unique:tenants,domain'],
            'fqdn' => ['nullable', 'string', 'max:255', 'unique:tenants,fqdn'],
            'admin_name' => ['required', 'string', 'max:255'],
            'admin_email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'admin_password' => ['required', 'string', 'min:8'],
        ]);

        DB::beginTransaction();
        try {
            // Create tenant
            $tenant = Tenant::create([
                'name' => $validated['name'],
                'domain' => $validated['domain'] ?? Str::slug($validated['name']) . '.bnicrm.local',
                'database' => 'tenant_' . Str::slug($validated['name']),
                'fqdn' => $validated['fqdn'],
                'is_active' => true,
            ]);

            // Create tenant admin user
            $user = User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'],
                'password' => Hash::make($validated['admin_password']),
            ]);

            // Assign admin role and attach to tenant
            $user->assignRole('tenant_admin');
            $user->tenants()->attach($tenant->id, ['role' => 'tenant_admin']);

            DB::commit();

            return redirect()->route('tenants.index')
                ->with('success', "Tenant '{$tenant->name}' created successfully with admin user.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Failed to create tenant: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified tenant.
     */
    public function show(Tenant $tenant): View
    {
        $tenant->load(['users' => function ($query) {
            $query->with('user');
        }]);

        return view('superadmin.tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified tenant.
     */
    public function edit(Tenant $tenant): View
    {
        return view('superadmin.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified tenant.
     */
    public function update(Request $request, Tenant $tenant): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tenants,name,' . $tenant->id],
            'domain' => ['nullable', 'string', 'max:255', 'unique:tenants,domain,' . $tenant->id],
            'fqdn' => ['nullable', 'string', 'max:255', 'unique:tenants,fqdn,' . $tenant->id],
            'is_active' => ['boolean'],
        ]);

        $tenant->update($validated);

        return redirect()->route('tenants.show', $tenant)
            ->with('success', 'Tenant updated successfully.');
    }

    /**
     * Remove the specified tenant.
     */
    public function destroy(Tenant $tenant): RedirectResponse
    {
        if ($tenant->users()->count() > 0) {
            return back()->withErrors(['error' => 'Cannot delete tenant with associated users. Remove users first.']);
        }

        $tenant->delete();

        return redirect()->route('tenants.index')
            ->with('success', 'Tenant deleted successfully.');
    }

    /**
     * Approve/Activate a pending tenant.
     */
    public function approve(Tenant $tenant): RedirectResponse
    {
        $tenant->update(['is_active' => true]);
        return back()->with('success', "Tenant '{$tenant->name}' has been activated.");
    }

    /**
     * Suspend a tenant.
     */
    public function suspend(Tenant $tenant): RedirectResponse
    {
        $tenant->update(['is_active' => false]);
        return back()->with('warning', "Tenant '{$tenant->name}' has been suspended.");
    }

    /**
     * Activate a suspended tenant.
     */
    public function activate(Tenant $tenant): RedirectResponse
    {
        $tenant->update(['is_active' => true]);
        return back()->with('success', "Tenant '{$tenant->name}' has been activated.");
    }
}