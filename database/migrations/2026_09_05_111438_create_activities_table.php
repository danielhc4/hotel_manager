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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('shifts_id');
            $table->enum('activity_type', ['DAILY', 'EXTRA']);
            $table->text('description');
            $table->unsignedBigInteger('employees_id')->nullable();
            $table->timestamps();

            $table->foreign('shifts_id')->references('id')->on('shifts')->onDelete('restrict');
            $table->foreign('employees_id')->references('id')->on('employees')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
