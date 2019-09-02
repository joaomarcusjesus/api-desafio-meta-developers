<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(ClientsTableSeeder::class);
    $this->call(SectorsTableSeeder::class);
    $this->call(ResponsiblesTableSeeder::class);
    $this->call(CallsTableSeeder::class);
    $this->call(HistoriesTableSeeder::class);
  }
}
