<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entry_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entry_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('student_number');
            $table->string('program');
            $table->string('year_level');
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entry_members');
    }
};
