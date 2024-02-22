<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropiosVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propios_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propios_id');
            $table->unsignedBigInteger('vehi_id');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('propios_id')->references('id')->on('propios')->onDelete('cascade');
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
        Schema::dropIfExists('propios_vehiculos');
    }
}

