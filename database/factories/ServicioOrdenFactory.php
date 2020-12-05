<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ServicioOrder::class, function (Faker $faker) {
    $ordenes = \App\Order::all();
    $servicios  = \App\CatServicio::all();
    return [
        'idOrden'=>$ordenes->random(),
        'idServicio'=>$servicios->random(),
        'cantidad'=>$faker->randomNumber(2),
        'subtotal'=>$faker->randomNumber(3),
    ];
});
