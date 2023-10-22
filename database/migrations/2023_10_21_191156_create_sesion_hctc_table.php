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
        Schema::create('sesion_hctc', function (Blueprint $table) {
            $table->bigInteger('id_sesion_hctc', true);
            $table->date('fecha_sesion')->nullable();
            $table->string('tipo_sesion', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesion_hctc');
    }
};
