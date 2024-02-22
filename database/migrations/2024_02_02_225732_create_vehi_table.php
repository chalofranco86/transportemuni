<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehi', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_vehi');
            $table->string('placa_vehi');
            $table->string('tarjeta_circulacion');
            $table->string('titulo_propiedad');
            $table->string('tipo_vehi');
            $table->unsignedBigInteger('numero_ruta_id');
            $table->foreign('numero_ruta_id')->references('id')->on('rutas');

        
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function create()
    {
        Schema::dropIfExists('vehi');
    }
};
