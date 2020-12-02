<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TblCostoTipoServicio;
use Faker\Generator as Faker;

$factory->define(TblCostoTipoServicio::class, function (Faker $faker) {
    $servicios = \App\CatServicio::all();
    return [
        'idServicio'=>$servicios->random(),
        'costo'=>$faker->randomNumber(3),
        'fechaCambio'=>$faker->dateTime,
        'fechaExpiracion'=>$faker->dateTime,
        'eliminado'=>rand(0,1)
    ];
});
