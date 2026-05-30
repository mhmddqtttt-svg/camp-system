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
        Schema::create('camp_transfer_requests', function (Blueprint $table) {

            $table->id();

            // العائلة
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // المخيم الحالي
            $table->foreignId('from_camp_id')
                ->constrained('camps')
                ->onDelete('cascade');

            // المخيم المطلوب النقل إليه
            $table->foreignId('to_camp_id')
                ->constrained('camps')
                ->onDelete('cascade');

            // المندوب الجديد
            $table->foreignId('to_delegate_id')
                ->constrained('users')
                ->onDelete('cascade');

            // سبب النقل
            $table->text('reason')->nullable();

            // حالة الطلب
            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp_transfer_requests');
    }
};
