<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_experiences_table.php
public function up(): void
{
    Schema::create('experiences', function (Blueprint $table) {
        $table->id();
        $table->foreignId('resume_id')->constrained()->onDelete('cascade');
        $table->string('job_title');
        $table->string('employer');
        $table->string('city')->nullable();
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->boolean('is_current')->default(false);
        
        // This is the field your AI will target later
        $table->text('description')->nullable(); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
