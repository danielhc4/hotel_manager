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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->time('monday_shift_entry')->nullable();
            $table->time('monday_shift_ending')->nullable();
            $table->time('tuesday_shift_entry')->nullable();
            $table->time('tuesday_shift_ending')->nullable();
            $table->time('wednesday_shift_entry')->nullable();
            $table->time('wednesday_shift_ending')->nullable();
            $table->time('thursday_shift_entry')->nullable();
            $table->time('thursday_shift_ending')->nullable();
            $table->time('friday_shift_entry')->nullable();
            $table->time('friday_shift_ending')->nullable();
            $table->time('saturday_shift_entry')->nullable();
            $table->time('saturday_shift_ending')->nullable();
            $table->time('sunday_shift_entry')->nullable();
            $table->time('sunday_shift_ending')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
