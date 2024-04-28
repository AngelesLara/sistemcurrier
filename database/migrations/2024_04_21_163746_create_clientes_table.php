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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('ID_Cliente');
            $table->integer('cliDNI')->unique();
            $table->string('cliNombre', 155);
            $table->string('cliDireccion' , 200);
            $table->integer('cliTelefono')->nullable();
            $table->unsignedBigInteger('ID_tpCliente');
            $table->timestamps();

            $table->foreign('ID_tpCliente')->references('ID_tpCliente')->on('tipoclientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
