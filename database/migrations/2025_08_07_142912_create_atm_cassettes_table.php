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
        Schema::create('atm_cassettes', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('atm_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('denomination');
            $table->unsignedInteger('max_sheets');
            $table->unsignedInteger('current_sheets')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atm_cassettes');
    }
};
