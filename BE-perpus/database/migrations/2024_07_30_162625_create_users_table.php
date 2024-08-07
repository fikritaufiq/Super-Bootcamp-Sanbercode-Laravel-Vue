<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai primary key
            $table->string('name'); // Kolom name
            $table->string('email')->unique(); // Kolom email yang unik
            $table->string('password'); // Kolom password
            $table->uuid('role_id'); // FK role_id
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            // Menambahkan timestamp
            $table->timestamps();

            // Menambahkan foreign key constraint
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}