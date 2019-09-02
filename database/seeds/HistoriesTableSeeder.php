<?php

use Illuminate\Database\Seeder;
use Tickets\Models\Call\History;

class HistoriesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(History::class, 100)->create();
  }
}
