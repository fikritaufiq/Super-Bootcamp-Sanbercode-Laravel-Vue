<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id_uuid')->primary();
            $table->text('critic')->nullable();
            $table->integer('rating');
            $table->uuid('user_id_uuid');
            $table->uuid('movie_id_uuid');
            $table->foreign('user_id_uuid')->references('id_uuid')->on('users');
            $table->foreign('movie_id_uuid')->references('id_uuid')->on('movies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
