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
        Schema::create('solicitud_opcion_titulacion', function (Blueprint $table) {
            $table->bigInteger('id_solicitud_OT', true);
            $table->date('fecha_solicitud')->nullable();
            $table->string('semestre', 15)->nullable();
            $table->dateTime('fecha_hora_coordinador')->nullable();
            $table->string('estado_solicitud', 15)->nullable();
            $table->bigInteger('clave_unica')->nullable();
            $table->bigInteger('rpe_staff')->nullable();
            $table->bigInteger('rpe_coordinador')->nullable();
            $table->bigInteger('id_opcion_titulacion')->nullable()->index('id_opcion_titulacion_idx');
            $table->bigInteger('id_sesion_hctc')->nullable()->index('id_sesion_hctc_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_opcion_titulacion');
    }
};
