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
        Schema::create('documentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('antecedentes_policiacos');
            $table->string('antecedentes_penales');
            $table->string('renas');
            $table->string('licentia_tipo');
            $table->string('dpi');
            $table->string('boleto_ornato');
            $table->string('direccion_fiscal');
            $table->string('correo_documento');
            $table->integer('telefono_documento');    
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
        Schema::dropIfExists('documentos');
    }
};
