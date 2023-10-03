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
        Schema::create('temario_autorizacion', function (Blueprint $table) {
            $table->bigInteger('id_temario', true);
            $table->integer('id_seccion')->nullable();
            $table->string('nombre_seccion', 45)->nullable();
            $table->bigInteger('id_solicitud_OT')->nullable()->index('id_solicitud_OT_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temario_autorizacion');
    }
};
