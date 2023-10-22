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
        Schema::create('datos_empresa', function (Blueprint $table) {
            $table->bigInteger('id_solicitud_OT')->primary();
            $table->string('nombre_empresa', 45)->nullable();
            $table->string('calle_empresa', 45)->nullable();
            $table->string('num_interior_empresa', 10)->nullable();
            $table->string('num_exterior_empresa', 10)->nullable();
            $table->string('colonia_empresa', 45)->nullable();
            $table->string('cp_empresa', 10)->nullable();
            $table->string('telefono_empresa', 20)->nullable();
            $table->string('correo_empresa', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_empresa');
    }
};
