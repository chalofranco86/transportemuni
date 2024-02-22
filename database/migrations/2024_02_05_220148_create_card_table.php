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
        Schema::create('card', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_piloto');
            $table->string('direccion_piloto');
            $table->string('correo_piloto');
            $table->string('telefono_piloto');
            $table->string('tipo_licencia');
            $table->string('licencia');
            $table->string('foto_piloto');
            $table->string('dpi_piloto');
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->string('antecedentes_penales');
            $table->string('antecedentes_policiacos');
            $table->string('renas');
            $table->string('boleto_ornato');

            $table->unsignedBigInteger('numero_vehiculo_id');
            $table->foreign('numero_vehiculo_id')->references('id')->on('vehi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card');
    }
};
