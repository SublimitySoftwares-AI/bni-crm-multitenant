<?php

namespace App\Actions\Livewire;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateTenant extends Component
{
    public string $name = '';
    public ?string $domain = '';
    public ?string $fqdn = '';
    public string $admin_name = '';
    public string $admin_email = '';
    public string $admin_password = '';
    public string $admin_password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'domain' => 'nullable|string|max:255',
        'fqdn' => 'nullable|string|max:255',
        'admin_name' => 'required|string|max:255',
        'admin_email' => 'required|email|unique:users,email',
        'admin_password' => 'required|min:8|confirmed',
    ];

    public function render()
    {
        return view('livewire.create-tenant')->layout('layouts.app');
    }

    public function createTenant()
    {
        $this->validate();

        // Create the tenant with landlord connection
        $tenant = Tenant::create([
            'name' => $this->name,
            'domain' => $this->domain,
            'fqdn' => $this->fqdn,
            'database' => 'tenant_' . \Illuminate\Support\Str::slug($this->name),
        ]);

        // Make this tenant the current one for user creation
        $tenant->makeCurrent();

        // Create the admin user
        $user = User::create([
            'name' => $this->admin_name,
            'email' => $this->admin_email,
            'password' => Hash::make($this->admin_password),
        ]);

        // Assign superadmin role to the user
        $user->assignRole('superadmin');

        // Switch back to landlord connection
        \App\Models\Tenant::landlord()->makeCurrent();

        session()->flash('success', "Tenant '{$tenant->name}' created successfully!");
        $this->reset();
    }
}