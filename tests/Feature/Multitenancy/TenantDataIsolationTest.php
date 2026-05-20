<?php

namespace Tests\Feature\Multitenancy;

use App\Models\Exhibition;
use App\Models\Lead;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantDataIsolationTest extends TestCase
{
    use RefreshDatabase;

    protected Tenant $tenantA;
    protected Tenant $tenantB;
    protected User $userA;
    protected User $userB;

    protected function setUp(): void
    {
        parent::setUp();

        // Create two tenants with their own databases
        $this->tenantA = Tenant::create([
            'name' => 'Tenant A',
            'domain' => 'tenant-a.local',
            'database' => 'tenant_a_db',
            'is_active' => true,
        ]);

        $this->tenantB = Tenant::create([
            'name' => 'Tenant B',
            'domain' => 'tenant-b.local',
            'database' => 'tenant_b_db',
            'is_active' => true,
        ]);

        // Create users for each tenant
        $this->userA = User::create([
            'name' => 'User A',
            'email' => 'usera@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->userA->tenants()->attach($this->tenantA->id, ['role' => 'tenant_admin']);

        $this->userB = User::create([
            'name' => 'User B',
            'email' => 'userb@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->userB->tenants()->attach($this->tenantB->id, ['role' => 'tenant_admin']);
    }

    public function test_leads_are_isolated_between_tenants(): void
    {
        // Create leads for Tenant A
        $this->tenantA->makeCurrent();
        Lead::create(['name' => 'Lead A1', 'email' => 'lead1@example.com', 'source' => 'exhibition']);
        Lead::create(['name' => 'Lead A2', 'email' => 'lead2@example.com', 'source' => 'referral']);

        // Create leads for Tenant B
        $this->tenantB->makeCurrent();
        Lead::create(['name' => 'Lead B1', 'email' => 'lead1@example.com', 'source' => 'card_scan']);

        // Switch back to Tenant A and verify only A's leads exist
        $this->tenantA->makeCurrent();
        $this->assertEquals(2, Lead::count());
        $this->assertTrue(Lead::where('name', 'Lead A1')->exists());
        $this->assertTrue(Lead::where('name', 'Lead A2')->exists());
        $this->assertFalse(Lead::where('name', 'Lead B1')->exists());

        // Switch to Tenant B and verify only B's leads exist
        $this->tenantB->makeCurrent();
        $this->assertEquals(1, Lead::count());
        $this->assertTrue(Lead::where('name', 'Lead B1')->exists());
        $this->assertFalse(Lead::where('name', 'Lead A1')->exists());

        // Return to landlord connection
        Tenant::landlord()->makeCurrent();
    }

    public function test_exhibitions_are_isolated_between_tenants(): void
    {
        // Create exhibitions for Tenant A
        $this->tenantA->makeCurrent();
        Exhibition::create([
            'name' => 'Exhibition A1',
            'start_date' => now(),
            'status' => 'published',
        ]);

        // Create exhibitions for Tenant B
        $this->tenantB->makeCurrent();
        Exhibition::create([
            'name' => 'Exhibition B1',
            'start_date' => now(),
            'status' => 'published',
        ]);

        // Switch to Tenant A and verify only A's exhibitions exist
        $this->tenantA->makeCurrent();
        $this->assertEquals(1, Exhibition::count());
        $this->assertTrue(Exhibition::where('name', 'Exhibition A1')->exists());
        $this->assertFalse(Exhibition::where('name', 'Exhibition B1')->exists());

        // Switch to Tenant B and verify only B's exhibitions exist
        $this->tenantB->makeCurrent();
        $this->assertEquals(1, Exhibition::count());
        $this->assertTrue(Exhibition::where('name', 'Exhibition B1')->exists());
        $this->assertFalse(Exhibition::where('name', 'Exhibition A1')->exists());

        Tenant::landlord()->makeCurrent();
    }

    public function test_users_belong_to_correct_tenants(): void
    {
        $this->assertTrue($this->userA->tenants->contains($this->tenantA));
        $this->assertFalse($this->userA->tenants->contains($this->tenantB));
        $this->assertTrue($this->userB->tenants->contains($this->tenantB));
        $this->assertFalse($this->userB->tenants->contains($this->tenantA));
    }

    public function test_tenant_model_has_correct_attributes(): void
    {
        $this->assertEquals('Tenant A', $this->tenantA->name);
        $this->assertEquals('tenant-a.local', $this->tenantA->domain);
        $this->assertEquals('tenant_a_db', $this->tenantA->database);
        $this->assertTrue($this->tenantA->is_active);
    }
}