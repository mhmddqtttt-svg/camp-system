<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('camp_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->foreignId('camp_id')->nullable()->constrained()->onDelete('set null');

            $table->string('first_name');
            $table->string('father_name');
            $table->string('grandfather_name');
            $table->string('family_name');

            $table->string('identity_number')->unique();

            $table->string('phone')->nullable();
            $table->string('backup_phone')->nullable();

            $table->date('birth_date')->nullable();
            $table->integer('age')->nullable();

            $table->enum('marital_status', [
                'single',
                'married',
                'widowed',
                'divorced',
                'polygamous',
            ]);

            $table->integer('family_members_count')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('camp_members');
    }
};
