<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Contato::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'telefone'   => $faker->cellphonenumber,
        'email' => $faker->unique()->safeEmail,
        'CEP'=> $faker->postcode
    ];
});
