<?php

namespace Tests\Unit;

use App\Models\Lead;
use PHPUnit\Framework\TestCase;

class LeadModelTest extends TestCase
{
    public function test_display_name_attribute(): void
    {
        $lead = new Lead(['name' => 'John Doe', 'company' => 'Acme Inc']);
        $this->assertEquals('John Doe - Acme Inc', $lead->display_name);
    }

    public function test_display_name_without_company(): void
    {
        $lead = new Lead(['name' => 'John Doe']);
        $this->assertEquals('John Doe', $lead->display_name);
    }

    public function test_fillable_attributes(): void
    {
        $lead = new Lead();
        $this->assertEquals([
            'name',
            'email',
            'phone',
            'company',
            'designation',
            'source',
            'notes',
            'created_by',
        ], $lead->getFillable());
    }
}