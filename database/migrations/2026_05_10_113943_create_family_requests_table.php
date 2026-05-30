<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_requests', function (Blueprint $table) {

            $table->id();

            $table->string('full_name');

            $table->string('identity_number');

            $table->string('phone');

            $table->foreignId('camp_id')
                ->constrained('camps')
                ->cascadeOnDelete();

            $table->decimal('amount', 8, 2)->default(5);

            $table->string('payment_image')->nullable();

            $table->string('email')->unique();

            $table->string('password');

            $table->enum('payment_status', [
                'pending',
                'paid',
                'rejected'
            ])->default('pending');

            $table->enum('status', [
                'pending_admin',
                'pending_delegate',
                'approved',
                'rejected_admin',
                'rejected_delegate',
            ])->default('pending_admin');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_requests');
    }
};
