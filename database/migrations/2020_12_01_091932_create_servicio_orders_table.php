<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('tbl_servicio_ordenes', function (Blueprint $table) {

            $table->increments('idServicioOrden');

            $table->integer('idOrden')->unsigned();
            $table->foreign('idOrden')->references('idOrden')->on('tbl_ordenes');

            $table->integer('idServicio')->unsigned();
            $table->foreign('idServicio')->references('idServicio')->on('cat_servicios');

            $table->integer('cantidad')->default(1);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_servicio_ordenes');
    }
}
