<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dynamic_report_responses', function (Blueprint $table) {

            $table->id();

            $table->foreignId('dynamic_report_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->json('answers');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dynamic_report_responses');
    }
};
