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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., 'super_admin'
            $table->string('label')->nullable(); // e.g., 'Super Admin'
            $table->timestamps();
        });

        // Optional: If you want a simple setup where 1 user has 1 role, 
        // add this to your users table migration instead of a pivot table.
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('role_id')->nullable()->constrained()->onDelete('set null');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};