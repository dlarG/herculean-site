<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->nullable()
                ->after('group')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->boolean('has_variants')
                ->default(false)
                ->after('parent_id');

            $table->integer('sort_order')
                ->default(0)
                ->after('has_variants'); // optional, for custom ordering
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['parent_id', 'has_variants', 'sort_order']);
        });
    }
};