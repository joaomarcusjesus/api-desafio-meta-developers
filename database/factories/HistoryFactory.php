<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Tickets\Models\Call\History;
use Tickets\Models\Call\Call;
use Tickets\Models\Responsible\Responsible;
use Faker\Generator as Faker;

$factory->define(History::class, function (Faker $faker) {
  return [
    'body' => $faker->text,
    'status' => $faker->numberBetween(1, 3),
    'responsible_id' => factory(Responsible::class)->create()->id,
    'call_id' => factory(Call::class)->create()->id,
  ];
});
