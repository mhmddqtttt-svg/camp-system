<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wives', function (Blueprint $table) {
            $table->id();

            $table->foreignId('camp_member_id')->constrained()->onDelete('cascade');

            $table->string('first_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('grandfather_name')->nullable();
            $table->string('family_name')->nullable();

            $table->string('identity_number')->nullable();

            $table->date('birth_date')->nullable();
            $table->integer('age')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wives');
    }
};
