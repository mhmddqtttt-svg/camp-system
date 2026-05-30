<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dynamic_reports', function (Blueprint $table) {

            $table->integer('duration_minutes')->nullable();

            $table->timestamp('opened_at')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('dynamic_reports', function (Blueprint $table) {

            $table->dropColumn([
                'duration_minutes',
                'opened_at'
            ]);

        });
    }
};
