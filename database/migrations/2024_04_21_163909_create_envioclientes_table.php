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
        Schema::create('envioclientes', function (Blueprint $table) {
            $table->id('ID_EnvCliente');
            $table->enum('ecNombre', ['Remitente', 'Destinatario']);
            $table->unsignedBigInteger('ID_Envio')->nullable();
            $table->unsignedBigInteger('ID_Cliente')->nullable();
            $table->timestamps();

            $table->foreign('ID_Envio')->references('ID_Envio')->on('envios')->onDelete('set null');
            $table->foreign('ID_Cliente')->references('ID_Cliente')->on('clientes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envioclientes');
    }
};
