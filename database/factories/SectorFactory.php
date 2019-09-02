<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Tickets\Models\Sector\Sector;

$factory->define(Sector::class, function (Faker $faker) {
  return [
    'name' => $faker->name,
    'active' => $faker->boolean(true),
  ];
});
