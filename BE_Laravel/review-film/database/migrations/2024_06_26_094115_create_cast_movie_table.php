<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCastMovieTable extends Migration
{
    public function up()
    {
        Schema::create('cast_movie', function (Blueprint $table) {
            $table->uuid('id_uuid')->primary();
            $table->string('name');
            $table->uuid('cast_id_uuid');
            $table->uuid('movie_id_uuid');
            $table->foreign('cast_id_uuid')->references('id_uuid')->on('casts');
            $table->foreign('movie_id_uuid')->references('id_uuid')->on('movies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cast_movie');
    }
}
