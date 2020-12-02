<?php

use Illuminate\Database\Seeder;

class RolTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = new \App\Rol();

        $rol->rol = 'administrador';
        $rol->eliminado = 0;
        $rol->save();

        $rol = new \App\Rol();

        $rol->rol = 'repartidor';
        $rol->eliminado = 0;
        $rol->save();

        $rol = new \App\Rol();

        $rol->rol = 'cliente';
        $rol->eliminado = 0;
        $rol->save();


    }
}
