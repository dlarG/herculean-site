<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coach_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['coach_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coach_category');
    }
};