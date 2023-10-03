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
        Schema::create('solicitud_registro_tema', function (Blueprint $table) {
            $table->bigInteger('id_solicitud_OT')->primary();
            $table->dateTime('fecha_solicitud')->nullable();
            $table->string('trabajo_recepcional', 45)->nullable()->default('Trabajo recepcional');
            $table->string('tema', 45)->nullable();
            $table->bigInteger('rpe_asesor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_registro_tema');
    }
};
