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
        Schema::create('encargadotrucks', function (Blueprint $table) {
            $table->id('ID_EncargadoTruck');
            $table->timestamp('etFecha');
            $table->tinyInteger('etEstado')->default(1);
            $table->unsignedBigInteger('ID_Camion')->nullable();
            $table->unsignedBigInteger('ID_Empleado')->nullable();
            $table->timestamps();

            $table->foreign('ID_Camion')->references('ID_Camion')->on('trucks')->onDelete('set null');
            $table->foreign('ID_Empleado')->references('ID_Empleado')->on('empleados')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encargadotrucks');
    }
};
