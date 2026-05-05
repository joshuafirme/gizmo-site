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
        Schema::create('who_we_are', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Who We Are');
            $table->string('heading');
            $table->text('main_content');
            $table->json('bullet_points')->nullable(); // Stores array of features
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('who_we_are');
    }
};
