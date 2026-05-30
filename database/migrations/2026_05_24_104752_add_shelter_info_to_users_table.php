<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('shelter_manager')->nullable();
            $table->string('shelter_phone')->nullable();
            $table->string('shelter_alt_phone')->nullable();
            $table->string('shelter_address')->nullable();
            $table->string('shelter_gps')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'shelter_manager',
                'shelter_phone',
                'shelter_alt_phone',
                'shelter_address',
                'shelter_gps',
            ]);
        });
    }
};
