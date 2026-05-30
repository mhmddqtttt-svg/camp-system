<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('role')->default('family');

            $table->string('phone')->nullable();

            $table->string('identity_number')->nullable();

            $table->string('status')->default('pending');

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'role',
                'phone',
                'identity_number',
                'status'
            ]);

        });
    }
};
