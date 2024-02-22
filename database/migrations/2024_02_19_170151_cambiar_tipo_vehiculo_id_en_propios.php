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
        Schema::disableForeignKeyConstraints(); // Desactiva restricciones de clave externa
    
        Schema::table('propios', function (Blueprint $table) {
            $table->longText('vehi_id')->nullable()->change();
        });
    
        Schema::enableForeignKeyConstraints(); // Vuelve a activar restricciones de clave externa
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
