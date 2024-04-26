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
        Schema::create('child_posts', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('slug')->unique();
            $table->string('author');
            $table->string('judul');
            $table->text('konten');
            $table->string('image_path')->nullable();
            $table->uuid('parent_post_uuid');
            $table->foreign('parent_post_uuid')->references('uuid')->on('parent_posts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_posts');
    }
};
