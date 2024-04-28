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
        Schema::create('envios', function (Blueprint $table) {
            $table->id('ID_Envio');
            $table->string('envCodigo', 30);
            $table->string('envDescripcion', 255);
            $table->enum('envEstado', ['En tránsito', 'Entregado', 'Retenido']);
            $table->timestamp('envFecha_Llegada');
            $table->unsignedBigInteger('ID_Destino_Remitente')->nullable();
            $table->unsignedBigInteger('ID_Destino_Destinatario')->nullable();
            $table->unsignedBigInteger('ID_User')->nullable();
            $table->timestamps();

            $table->foreign('ID_Destino_Remitente')->references('ID_Destino')->on('destinos')->onDelete('set null');
            $table->foreign('ID_Destino_Destinatario')->references('ID_Destino')->on('destinos')->onDelete('set null');
            $table->foreign('ID_User')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
