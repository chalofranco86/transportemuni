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
        Schema::create('propios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_propietario');
            $table->string('dpi_propietario');
            $table->string('nit_propietario');
            $table->string('telefono_propietario');
            $table->string('correo_propietario');
            $table->string('direccion_fiscal');
            $table->integer('numero_vehiculos_asociados')->default(0);
            $table->json('vehiculos_asociados')->nullable();
            $table->string('nombre_empresa')->nullable();
            $table->string('nit_empresa')->nullable();
            $table->timestamps();
        
            // Relación con la tabla Vehi
            $table->unsignedBigInteger('vehi_id')->nullable();
            $table->foreign('vehi_id')->references('id')->on('vehi')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propios');
    }
};
