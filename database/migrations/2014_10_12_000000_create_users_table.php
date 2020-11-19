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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',20);
            $table->string('lastName');
            $table->string('email',50)->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('confirmation_password');
            $table->enum('status', ['active','inactive']);
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            //$table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        
        Schema::dropIfExists('users');
    }
}
