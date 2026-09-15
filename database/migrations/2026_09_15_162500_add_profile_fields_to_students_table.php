<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('program')->nullable()->after('full_name');
            $table->string('year_level')->nullable()->after('program');
            $table->string('gender')->nullable()->after('year_level');
            $table->string('contact_number')->nullable()->after('gender');
            $table->string('facebook_link')->nullable()->after('contact_number');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'program',
                'year_level',
                'gender',
                'contact_number',
                'facebook_link',
            ]);
        });
    }
};