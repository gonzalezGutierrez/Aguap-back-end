<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_usuarios', function (Blueprint $table) {
            $table->increments('idUsuario');
            $table->string('name');
            $table->string('lastName');
            $table->string('email',50)->unique();
            $table->string('phone')->unique();
            $table->integer('idRol')->unsigned();
            $table->foreign('idRol')->references('idRol')->on('tbl_roles');
            $table->string('password');
            $table->tinyInteger('eliminado')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('tbl_usuarios');
    }
}
