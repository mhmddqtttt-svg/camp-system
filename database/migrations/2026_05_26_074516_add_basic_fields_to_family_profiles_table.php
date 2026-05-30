<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::table('family_profiles', function (Blueprint $table) {
        if (!Schema::hasColumn('family_profiles', 'gender')) {
            $table->string('gender')->nullable();
        }

        if (!Schema::hasColumn('family_profiles', 'birth_date')) {
            $table->date('birth_date')->nullable();
        }

        if (!Schema::hasColumn('family_profiles', 'age')) {
            $table->integer('age')->nullable();
        }

        if (!Schema::hasColumn('family_profiles', 'backup_phone')) {
            $table->string('backup_phone')->nullable();
        }

        if (!Schema::hasColumn('family_profiles', 'family_members_count')) {
            $table->integer('family_members_count')->nullable();
        }
    });
}

public function down(): void
{
    Schema::table('family_profiles', function (Blueprint $table) {
        $table->dropColumn([
            'gender',
            'birth_date',
            'age',
            'backup_phone',
            'family_members_count',
        ]);
    });
}
};
