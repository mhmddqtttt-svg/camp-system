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
    Schema::create('reports', function (Blueprint $table) {

        $table->id();

        $table->foreignId('family_request_id')
              ->constrained()
              ->onDelete('cascade');

        $table->foreignId('delegate_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->text('report');

        $table->enum('status', ['pending', 'approved', 'rejected'])
              ->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};