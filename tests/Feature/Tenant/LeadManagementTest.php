<?php

namespace Tests\Feature\Tenant;

use App\Models\Lead;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadManagementTest extends TestCase
{
    use RefreshDatabase;

    protected Tenant $tenant;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tenant = Tenant::create([
            'name' => 'Test Tenant',
            'domain' => 'test.local',
            'database' => 'test_db',
            'is_active' => true,
        ]);

        $this->user = User::create([
            'name' => 'Tenant User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
        ]);
        $this->user->tenants()->attach($this->tenant->id, ['role' => 'tenant_admin']);
    }

    public function test_user_can_create_lead(): void
    {
        $this->tenant->makeCurrent();
        $this->actingAs($this->user);

        $response = $this->post('/leads', [
            'name' => 'Test Lead',
            'email' => 'lead@test.com',
            'phone' => '1234567890',
            'company' => 'Test Company',
            'source' => 'exhibition',
        ]);

        $this->assertDatabaseHas('leads', [
            'name' => 'Test Lead',
            'email' => 'lead@test.com',
        ]);
    }

    public function test_lead_requires_name(): void
    {
        $this->tenant->makeCurrent();
        $this->actingAs($this->user);

        $response = $this->post('/leads', [
            'email' => 'lead@test.com',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_user_can_view_leads(): void
    {
        $this->tenant->makeCurrent();
        $this->actingAs($this->user);

        Lead::create(['name' => 'Test Lead', 'email' => 'test@test.com', 'source' => 'referral']);

        $response = $this->get('/leads');
        $response->assertStatus(200);
        $response->assertSee('Test Lead');
    }

    public function test_user_can_update_lead(): void
    {
        $this->tenant->makeCurrent();
        $this->actingAs($this->user);

        $lead = Lead::create(['name' => 'Original Name', 'email' => 'test@test.com', 'source' => 'referral']);

        $response = $this->put("/leads/{$lead->id}", [
            'name' => 'Updated Name',
            'email' => 'test@test.com',
            'source' => 'referral',
        ]);

        $this->assertDatabaseHas('leads', [
            'id' => $lead->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_user_can_delete_lead(): void
    {
        $this->tenant->makeCurrent();
        $this->actingAs($this->user);

        $lead = Lead::create(['name' => 'To Delete', 'email' => 'delete@test.com', 'source' => 'referral']);

        $response = $this->delete("/leads/{$lead->id}");
        $this->assertDatabaseMissing('leads', ['id' => $lead->id]);
    }
}