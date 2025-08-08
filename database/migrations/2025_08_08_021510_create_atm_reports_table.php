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
        Schema::create('atm_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('atm_id')->constrained()->cascadeOnDelete();
            $table->string('problem_code')->nullable();
            $table->timestamp('reported_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atm_reports');
    }
};
