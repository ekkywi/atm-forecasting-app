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
            $table->unsignedTinyInteger('cassette_index'); // Nomor urut kaset (1, 2, 3, 4)
            $table->unsignedInteger('denomination');
            $table->unsignedInteger('max_sheets')->default(2000); // Pagu per kaset
            $table->unique(['atm_id', 'cassette_index']);
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
