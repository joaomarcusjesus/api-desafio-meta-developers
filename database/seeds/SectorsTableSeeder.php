<?php

use Illuminate\Database\Seeder;

use Tickets\Models\Sector\Sector;

class SectorsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(Sector::class, 4)->create();
  }
}
