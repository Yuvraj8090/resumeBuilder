<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_templates_table.php
public function up()
{
    Schema::create('templates', function (Blueprint $table) {
        $table->id();
        $table->string('name');           // Display Name (e.g., "Corporate Blue")
        $table->string('slug')->unique(); // Unique ID string (e.g., "corporate-blue")
        $table->longText('html_code');    // The actual HTML/Blade code
        $table->string('thumbnail')->nullable(); // URL to the preview image
        $table->boolean('is_premium')->default(false); // For your pricing model
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
