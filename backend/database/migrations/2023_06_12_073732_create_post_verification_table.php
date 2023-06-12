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
        Schema::create('post_verification', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id');
            $table->string('receipt_file', 50)->comment('(DC2Type:array)');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_verification');
    }
};
