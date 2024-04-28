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
        Schema::create('trucks', function (Blueprint $table) {
            $table->id('ID_Camion');
            $table->string('truPlaca',30)->unique();
            $table->string('truSOAT', 8);
            $table->string('truMarca', 30);
            $table->string('truCapacidadPeso', 30);
            $table->tinyInteger('truEstado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trucks');
    }
};
