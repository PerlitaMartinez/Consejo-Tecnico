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
        Schema::create('solicitud_materia_unica', function (Blueprint $table) {
            $table->bigInteger('id_solicitud_mu', true);
            $table->date('fecha_solicitud')->nullable();
            $table->string('semestre', 15)->nullable();
            $table->dateTime('fecha_impresion')->nullable();
            $table->dateTime('fecha_hora_tutor')->nullable();
            $table->string('estado_solicitud', 15)->nullable()->default('ALTA');;
            $table->bigInteger('clave_unica')->nullable();
            $table->bigInteger('rpe_tutor')->nullable();
            $table->bigInteger('rpe_staff')->nullable();
            $table->bigInteger('id_sesion_hctc')->nullable()->index('id_sesion_hctc_idx');
            $table->char('clave_materia', 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_materia_unica');
    }
};
