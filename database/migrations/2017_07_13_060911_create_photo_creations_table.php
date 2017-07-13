<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_creations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creation_id')->unsigned();
            $table->string('photo');
            $table->timestamps();

            $table->foreign('creation_id')->references('creation_id')->on('creations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_creations');
    }
}
