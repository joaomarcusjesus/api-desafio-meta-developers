<?php

use Illuminate\Database\Seeder;
use Tickets\Models\Call\Call;

class CallsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(Call::class, 20)->create();
  }
}
