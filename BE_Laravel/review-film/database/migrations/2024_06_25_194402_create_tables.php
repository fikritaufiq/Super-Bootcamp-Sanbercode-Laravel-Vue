<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->timestamp('email_verified_at')->nullable();
            $table->uuid('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('age');
            $table->text('biodata');
            $table->text('address');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('movies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 255);
            $table->text('summary');
            $table->string('poster', 255)->nullable();
            $table->uuid('genre_id');
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->string('year', 4);
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('critic');
            $table->integer('rating');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->uuid('movie_id');
            $table->foreign('movie_id')->references('id')->on('movies');
        });

        Schema::create('casts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->integer('age');
            $table->text('bio');
        });

        Schema::create('cast_movie', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cast_id');
            $table->foreign('cast_id')->references('id')->on('casts');
            $table->uuid('movie_id');
            $table->foreign('movie_id')->references('id')->on('movies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cast_movie');
        Schema::dropIfExists('casts');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('movies');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
}