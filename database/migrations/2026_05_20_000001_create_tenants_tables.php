<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('domain')->unique()->nullable();
            $table->string('database')->unique();
            $table->string('fqdn')->unique()->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('meta')->nullable(); // For additional tenant settings
            $table->timestamps();
        });

        Schema::create('tenant_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('role')->nullable(); // tenant_admin, tenant_staff
            $table->timestamp('joined_at')->useCurrent();
            $table->timestamps();

            $table->unique(['tenant_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_users');
        Schema::dropIfExists('tenants');
    }
};