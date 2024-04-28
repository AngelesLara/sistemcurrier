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
        Schema::create('paquetes', function (Blueprint $table) {
            $table->id('ID_Paquete');
            $table->string('paqCodigo', 30);
            $table->string('paqDescripcion', 255);
            $table->decimal('paqPrecio', 10, 2);
            $table->decimal('paqPeso', 10, 2);
            $table->string('paqTamaño', 50);
            $table->unsignedBigInteger('ID_Envio')->nullable();
            $table->timestamps();

            $table->foreign('ID_Envio')->references('ID_Envio')->on('envios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paquetes');
    }
};
