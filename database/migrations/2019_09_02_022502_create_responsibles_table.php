<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsiblesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('responsibles', function (Blueprint $table) {
      $table->increments('id');
      $table->string('first_name', 255);
      $table->string('last_name', 255);
      $table->string('email', 255)->unique();
      $table->char('cpf', 40)->unique();
      $table->boolean('active')->nullable()->default(0);
      $table->unsignedInteger('sector_id');
      $table->foreign('sector_id')->references('id')->on('sectors');
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
    Schema::dropIfExists('responsibles');
  }
}
