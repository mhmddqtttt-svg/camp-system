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
        Schema::create('family_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_request_id')->constrained()->onDelete('cascade');

$table->string('gender')->nullable();
$table->string('marital_status')->nullable();

$table->string('wife_name')->nullable();
$table->string('wife_identity_number')->nullable();

$table->integer('total_family_members')->default(0);

$table->integer('children_0_2_male')->default(0);
$table->integer('children_0_2_female')->default(0);

$table->integer('children_3_5_male')->default(0);
$table->integer('children_3_5_female')->default(0);

$table->integer('children_6_18_male')->default(0);
$table->integer('children_6_18_female')->default(0);

$table->integer('members_19_60_male')->default(0);
$table->integer('members_19_60_female')->default(0);

$table->integer('members_above_60_male')->default(0);
$table->integer('members_above_60_female')->default(0);

$table->integer('disabled_members')->default(0);
$table->integer('chronic_disease_members')->default(0);
$table->integer('pregnant_or_nursing')->default(0);

$table->string('current_address')->nullable();
$table->string('original_address')->nullable();
$table->string('governorate')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_profiles');
    }
};
