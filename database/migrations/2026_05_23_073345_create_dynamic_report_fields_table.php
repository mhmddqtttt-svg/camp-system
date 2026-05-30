<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dynamic_report_fields', function (Blueprint $table) {

            $table->id();

            $table->foreignId('dynamic_report_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('label');

            $table->string('type')->default('text');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dynamic_report_fields');
    }
};
