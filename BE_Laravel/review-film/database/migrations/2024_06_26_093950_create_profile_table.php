<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('age');
            $table->text('biodata')->nullable();
            $table->text('address')->nullable();
            $table->uuid('user_id_uuid');
            $table->foreign('user_id_uuid')->references('id_uuid')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile');
    }
}

