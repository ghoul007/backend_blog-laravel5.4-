<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorMovrieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_movie', function (Blueprint $table) {

            $table->integer('movie_id')->unsigned()->nullable();
            $table->foreign('movie_id')->references('id')->on('Movie')->onDelete('cascade');
            $table->integer('actor_id')->unsigned()->nullable();
            $table->foreign('actor_id')->references('id')->on('Actor')->onDelete('cascade');

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
        Schema::dropIfExists('actor_movie');
    }
}
