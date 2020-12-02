<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Ubication::class, function (Faker $faker) {
    $users = \App\User::all();
    return [
        'idUsuario'=>$users->random(),
        'latitude'=>$faker->latitude,
        'longitude'=>$faker->longitude,
        'address'=>$faker->address,
        'is_GPS'=>$faker->boolean
    ];
});
