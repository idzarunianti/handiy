<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creations', function (Blueprint $table) {
            $table->increments('creation_id');
            $table->string('kreasi');
            $table->string('photo_url');
            $table->string('username');
            $table->integer('tutorial_id')->unsigned();
            $table->timestamps();

            $table->foreign('tutorial_id')->references('id')->on('tutorials');
            $table->foreign('username')->references('username')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creations');
    }
}
