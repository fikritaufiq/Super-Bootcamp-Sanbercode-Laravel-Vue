<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->uuid('id_uuid')->primary();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->string('poster')->nullable();
            $table->uuid('genre_id_uuid');
            $table->year('year');
            $table->foreign('genre_id_uuid')->references('id_uuid')->on('genres');
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
