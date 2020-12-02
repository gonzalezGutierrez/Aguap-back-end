<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCostoTipoServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_costo_tipo_servicios', function (Blueprint $table) {
            $table->increments('idCostoTipoServicio');
            $table->integer('idServicio')->unsigned();
            $table->foreign('idServicio')->references('idServicio')->on('cat_servicios');
            $table->double('costo');
            $table->dateTime('fechaCambio');
            $table->dateTime('fechaExpiracion');
            $table->tinyInteger('eliminado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_costo_tipo_servicios');
    }
}
