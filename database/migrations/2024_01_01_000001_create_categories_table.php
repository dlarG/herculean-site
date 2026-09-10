<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('group'); // Athletics / Visual Arts / Music / Literary-Musical / Dance
            $table->string('gender_division')->default('Open'); // Men / Women / Open
            $table->unsignedInteger('min_members')->default(1);
            $table->unsignedInteger('max_members')->default(1);
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
