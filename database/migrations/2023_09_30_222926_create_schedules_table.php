<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
          $table->id();
          $table->string('caption');
          $table->string('detail')->nullable();
          $table->dateTime('datetime')->nullable();
          $table->string('image1')->nullable();
          $table->string('image2')->nullable();
          $table->string('image3')->nullable();
          $table->string('image4')->nullable();
          $table->string('image5')->nullable();
          $table->string('file1')->nullable();
          $table->string('file2')->nullable();
          $table->string('file3')->nullable();
          $table->string('file4')->nullable();
          $table->string('file5')->nullable();
          $table->string('maplink')->nullable();
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
        Schema::dropIfExists('schedules');
    }
};
