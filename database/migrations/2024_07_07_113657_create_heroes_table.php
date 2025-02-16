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
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // For "Habil"
            $table->string('title'); // For "Professional Software Developer."
            $table->text('description'); // For the lead paragraph
            $table->string('cv_link')->nullable(); // For the Download CV link
            $table->json('social_links')->nullable(); // Store social media links as JSON
            $table->text('code_snippet')->nullable(); // Code for VCodeBlock
            $table->text('my_description')->nullable(); // Code for VCodeBlock
            $table->string('my_image')->nullable(); // Code for VCodeBlock
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
