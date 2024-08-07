<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->uuid('id')->primary(); // PK Id UUID NOT NULL
            $table->text('bio'); // Kolom bio
            $table->integer('age')->nullable(); // Kolom age, bisa null
            $table->uuid('user_id'); // FK user_id UUID
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}