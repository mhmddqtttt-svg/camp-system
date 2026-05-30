<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dynamic_reports', function (Blueprint $table) {

            $table->timestamp('expire_at')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('dynamic_reports', function (Blueprint $table) {

            $table->dropColumn('expire_at');

        });
    }
};
