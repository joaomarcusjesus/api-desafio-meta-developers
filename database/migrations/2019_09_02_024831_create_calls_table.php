<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('calls', function (Blueprint $table) {
      $table->increments('id');
      $table->string('code')->unique();
      $table->text('body')->nullable();
      $table->unsignedInteger('client_id')->unsigned()->index();
      $table->foreign('client_id')->references('id')->on('clients');
      $table->unsignedInteger('sector_id')->unsigned()->index();
      $table->foreign('sector_id')->references('id')->on('sectors');
      $table->unsignedInteger('status')->default(1);
      $table->boolean('active')->nullable()->default(0);
      $table->timestamps();
    });

    Schema::create('calls_histories', function (Blueprint $table) {
      $table->increments('id');
      $table->string('code')->unique();
      $table->text('body')->nullable();
      $table->unsignedInteger('status')->nullable()->default(0);
      $table->unsignedInteger('call_id')->index()->nullable();
      $table->foreign('call_id')->references('id')->on('calls')->onDelete('cascade');
      $table->unsignedInteger('responsible_id')->index()->nullable();
      $table->foreign('responsible_id')->references('id')->on('responsibles')->onDelete('cascade');
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
    Schema::dropIfExists('calls_histories');
    Schema::dropIfExists('calls');
  }
}
