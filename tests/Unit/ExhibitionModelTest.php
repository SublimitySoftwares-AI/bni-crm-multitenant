<?php

namespace Tests\Unit;

use App\Models\Exhibition;
use PHPUnit\Framework\TestCase;

class ExhibitionModelTest extends TestCase
{
    public function test_is_active_returns_true_for_ongoing(): void
    {
        $exhibition = new Exhibition(['status' => 'ongoing']);
        $this->assertTrue($exhibition->isActive());
    }

    public function test_is_active_returns_false_for_non_ongoing(): void
    {
        $exhibition = new Exhibition(['status' => 'draft']);
        $this->assertFalse($exhibition->isActive());
    }

    public function test_is_upcoming_for_published_future_exhibition(): void
    {
        $exhibition = new Exhibition([
            'status' => 'published',
            'start_date' => now()->addDays(7),
        ]);
        $this->assertTrue($exhibition->isUpcoming());
    }

    public function test_is_not_upcoming_for_past_exhibition(): void
    {
        $exhibition = new Exhibition([
            'status' => 'published',
            'start_date' => now()->subDays(7),
        ]);
        $this->assertFalse($exhibition->isUpcoming());
    }

    public function test_fillable_attributes(): void
    {
        $exhibition = new Exhibition();
        $this->assertContains('name', $exhibition->getFillable());
        $this->assertContains('status', $exhibition->getFillable());
        $this->assertContains('start_date', $exhibition->getFillable());
    }
}