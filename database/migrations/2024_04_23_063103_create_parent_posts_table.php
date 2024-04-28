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
        Schema::create('parent_posts', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('slug')->unique();
            $table->string('judul');
            $table->string('image_path')->nullable();
            $table->uuid('category_uuid');
            $table->foreign('category_uuid')->references('uuid')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_posts');
    }
};
