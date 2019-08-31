<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('clients', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('first_name', 255);
      $table->string('last_name', 255);
      $table->string('email', 255)->unique();
      $table->char('cpf', 40)->unique();
      $table->char('phone', 40)->nullable();
      $table->boolean('active')->nullable()->default(0);
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('clients');
  }
}
