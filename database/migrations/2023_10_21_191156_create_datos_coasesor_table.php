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
        Schema::create('datos_coasesor', function (Blueprint $table) {
            $table->bigInteger('id_solicitud_OT')->primary();
            $table->string('nombre_coasesor', 45)->nullable();
            $table->bigInteger('rpe_coasesor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_coasesor');
    }
};
