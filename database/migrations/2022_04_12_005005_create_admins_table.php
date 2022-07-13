<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('admins', function (Blueprint $table) {
      $table->id('admin_id');
      $table->string('admin_firstname', 30);
      $table->string('admin_lastname', 30);
      $table->string('admin_email', 255)->unique();
      $table->string('admin_username', 50)->unique();
      $table->string('admin_password', 255);
      $table->string('admin_phone')->unique();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('admins');
  }
}
