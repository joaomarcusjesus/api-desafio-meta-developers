<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Tickets\Models\Call\Call;
use Tickets\Models\Client\Client;
use Tickets\Models\Sector\Sector;
use Faker\Generator as Faker;

$factory->define(Call::class, function (Faker $faker) {
  return [
    'body' => $faker->text,
    'active' => $faker->boolean(true),
    'status' => $faker->numberBetween(1, 3),
    'client_id' => factory(Client::class)->create()->id,
    'sector_id' => factory(Sector::class)->create()->id,
  ];
});
