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
        Schema::create('child_post_parent_post', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('parent_post_uuid');
            $table->uuid('child_post_uuid');
            $table->foreign('child_post_uuid')->references('uuid')->on('child_posts')->onDelete('cascade');
            $table->foreign('parent_post_uuid')->references('uuid')->on('parent_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_post_parent_post');
    }
};
