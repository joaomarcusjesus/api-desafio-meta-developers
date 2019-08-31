<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Tickets\Models\Client\Client;

$factory->define(Client::class, function (Faker $faker) {
  return [
    'first_name' => $faker->name,
    'last_name' => $faker->lastname,
    'email' => $faker->unique()->safeEmail,
    'cpf' => $faker->unique()->randomNumber(5),
    'active' => $faker->boolean(true),
    'phone' => $faker->randomNumber(2)
  ];
});
