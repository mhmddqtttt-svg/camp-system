<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dynamic_report_fields', function (Blueprint $table) {
            $table->integer('min_age')->nullable()->after('type');
            $table->integer('max_age')->nullable()->after('min_age');
        });
    }

    public function down(): void
    {
        Schema::table('dynamic_report_fields', function (Blueprint $table) {
            $table->dropColumn(['min_age', 'max_age']);
        });
    }
};
