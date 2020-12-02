<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ordenes', function (Blueprint $table) {
            $table->increments('idOrden');
            $table->integer('idCliente')->unsigned();
            $table->foreign('idCliente')->references('idUsuario')->on('tbl_usuarios');
            $table->integer('idRepartidor')->unsigned()->nullable();
            $table->foreign('idRepartidor')->references('idUsuario')->on('tbl_usuarios');
            $table->integer('idUbicacion')->unsigned()->nullable();
            $table->foreign('idUbicacion')->references('idUbicacion')->on('tbl_ubicaciones');
            $table->date('fechaOrden')->nullable();
            $table->tinyInteger('estatus')->default(0);
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
        Schema::dropIfExists('tbl_ordenes');
    }
}
