<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('resumes', function (Blueprint $table) {
        // Drop the old column if it exists
        if (Schema::hasColumn('resumes', 'template_style')) {
            $table->dropColumn('template_style');
        }
        
        // Add the link to the templates table
        // constrained() ensures if a template is deleted, we know about it
        $table->foreignId('template_id')->nullable()->constrained('templates')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
