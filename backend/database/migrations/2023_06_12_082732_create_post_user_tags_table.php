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
        Schema::create('post_user_tags', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id');
            $table->integer('tagged_by_user');
            $table->integer('tagged_user');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('tagged_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tagged_by_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_user_tags');
    }
};
