<?php

use Illuminate\Database\Seeder;
use Tickets\Models\Responsible\Responsible;

class ResponsiblesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(Responsible::class, 50)->create();
  }
}
