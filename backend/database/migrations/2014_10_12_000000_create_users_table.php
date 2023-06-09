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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 50)->unique();
            $table->string('phone_number', 100)->nullable();
            $table->string('profile_image', 50)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->integer('credibility')->default(0);
            $table->string('password', 64);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
