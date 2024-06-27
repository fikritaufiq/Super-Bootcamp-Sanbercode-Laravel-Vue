<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->string('poster')->nullable();
            $table->year('year');
            $table->uuid('genre_id');
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->index('genre_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
