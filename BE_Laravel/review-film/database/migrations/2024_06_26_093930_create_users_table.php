<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id_uuid')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->uuid('role_id_uuid')->nullable();
            $table->foreign('role_id_uuid')->references('id_uuid')->on('roles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
