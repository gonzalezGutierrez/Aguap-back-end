<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CatServicio;
use Faker\Generator as Faker;

$factory->define(CatServicio::class, function (Faker $faker) {
    $servicios = array(
        'llenado de garrafones a domicilio',
        'llenado de garrafones en local',
        'venta de garrafón vacio',
        'venta de garrafón lleno'
    );
    return [
        'descripcion'=>$servicios[rand(0,2)]
    ];
});
