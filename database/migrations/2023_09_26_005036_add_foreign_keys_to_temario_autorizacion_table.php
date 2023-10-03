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
        Schema::table('temario_autorizacion', function (Blueprint $table) {
            $table->foreign(['id_solicitud_OT'], 'id_solicitud_OT')->references(['id_solicitud_OT'])->on('solicitud_registro_tema')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temario_autorizacion', function (Blueprint $table) {
            $table->dropForeign('id_solicitud_OT');
        });
    }
};
