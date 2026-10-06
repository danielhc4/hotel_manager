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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 256);
            $table->string('middle_name', 256)->nullable();
            $table->string('paternal_surename', 256);
            $table->string('maternal_surename', 256);
            $table->unsignedBigInteger('departments_id');
            $table->unsignedBigInteger('shifts_id');
            $table->string('phone', 10);
            $table->string('address', 256)->nullable();
            $table->enum('state', ['ACTIVE', 'ON_VACATIONS', 'ABSENT']);

            $table->foreign('departments_id')->references('id')->on('departments')->onDelete('restrict');
            $table->foreign('shifts_id')->references('id')->on('shifts')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
