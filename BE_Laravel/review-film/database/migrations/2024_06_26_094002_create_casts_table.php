<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
class CreateCastsTable extends Migration
{
    public function up()
    {
        Schema::create('casts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->integer('age');
            $table->text('bio');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('casts');
    }
}
