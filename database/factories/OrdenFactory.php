<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Order::class, function (Faker $faker) {
    $usuarios = \App\User::all();
    $ubicaciones = \App\Ubication::all();
    return [
        'idCliente'=>$usuarios->random()->idUsuario,
        'idRepartidor' =>$usuarios->random()->idUsuario,
        'idUbicacion'=>$ubicaciones->random()->idUbicacion,
        'fechaOrden' => $faker->date(),
        'estatus'=>0
    ];
});
