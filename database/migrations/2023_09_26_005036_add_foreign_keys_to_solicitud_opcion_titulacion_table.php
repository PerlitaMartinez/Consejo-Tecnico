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
        Schema::table('solicitud_opcion_titulacion', function (Blueprint $table) {
            $table->foreign(['id_opcion_titulacion'], 'id_opcion_titulacion_OT')->references(['id_opcion_titulacion'])->on('cat_opcion_titulacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_sesion_hctc'], 'id_sesion_hctc_OT')->references(['id_sesion_hctc'])->on('sesion_hctc')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_opcion_titulacion', function (Blueprint $table) {
            $table->dropForeign('id_opcion_titulacion_OT');
            $table->dropForeign('id_sesion_hctc_OT');
        });
    }
};
