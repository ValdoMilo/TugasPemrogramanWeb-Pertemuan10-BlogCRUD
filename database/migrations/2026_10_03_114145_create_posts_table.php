<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('category')->default('Umum');
            $table->string('status')->default('draft'); // draft, published
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Bonus: soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};