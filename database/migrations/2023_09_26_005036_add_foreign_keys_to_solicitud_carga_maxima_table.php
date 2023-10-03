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
        Schema::table('solicitud_carga_maxima', function (Blueprint $table) {
            $table->foreign(['id_sesion_hctc'], 'id_sesion_hctc_cm')->references(['id_sesion_hctc'])->on('sesion_hctc')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_carga_maxima', function (Blueprint $table) {
            $table->dropForeign('id_sesion_hctc_cm');
        });
    }
};
