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
        Schema::create('datos_personales_alumno', function (Blueprint $table) {
            $table->bigInteger('id_solicitud_OT')->primary();
            $table->string('calle_alumno', 45)->nullable();
            $table->string('num_interior_alumno', 10)->nullable();
            $table->string('num_exterior_alumno', 10)->nullable();
            $table->string('colonia_alumno', 45)->nullable();
            $table->string('cp_alumno', 10)->nullable();
            $table->string('telefono_alumno', 20)->nullable();
            $table->string('correo_alumno', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_personales_alumno');
    }
};
