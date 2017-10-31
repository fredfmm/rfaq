<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag_name');
            $table->timestamps();
        });

        Schema::create('question_tag', function (Blueprint $table) {
            $table->integer('question_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->unique(['question_id', 'tag_id']);
            
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tags');
        Schema::dropIfExists('question_tag');
        Schema::enableForeignKeyConstraints();
    }
}
