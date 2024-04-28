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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('ID_Empleado');
            $table->string('empCodigo', 30)->unique();
            $table->string('empNombre', 150);
            $table->integer('empTelefono');
            $table->string('empEmail', 100);
            $table->string('empDireccion', 255);
            $table->string('empCargo', 50);
            $table->decimal('empSueldo', 8,2);
            $table->tinyInteger('empEstado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
