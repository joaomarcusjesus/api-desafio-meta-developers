<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Tickets\Models\Responsible\Responsible;
use Tickets\Models\Sector\Sector;

$factory->define(Responsible::class, function (Faker $faker) {
  return [
    'first_name' => $faker->name,
    'last_name' => $faker->lastname,
    'email' => $faker->unique()->safeEmail,
    'cpf' => $faker->unique()->randomNumber(5),
    'active' => $faker->boolean(true),
    'sector_id' => factory(Sector::class)->create()->id
  ];
});
