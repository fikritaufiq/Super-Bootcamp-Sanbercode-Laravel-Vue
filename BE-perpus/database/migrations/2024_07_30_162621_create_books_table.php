<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary(); // PK id UUID NOT NULL
            $table->string('title', 255); // Kolom title varchar(255)
            $table->text('summary'); // Kolom summary text
            $table->string('image', 255); // Kolom image varchar(255)
            $table->integer('stok'); // Kolom stok integer(8)
            $table->uuid('category_id'); // FK category_id UUID

            // Menambahkan foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}