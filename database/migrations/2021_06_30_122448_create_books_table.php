<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->text('brief_en');
            $table->string('name_ar');
            $table->text('brief_ar');
            $table->enum('type', ['book', 'summary', 'podcast']);
            $table->integer('duration');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('narrator_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status');
            $table->tinyInteger('free');
            $table->tinyInteger('demo');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('narrator_id')->references('id')->on('narrators');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('books');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
