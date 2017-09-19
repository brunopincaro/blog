<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //The pivot table
        Schema::create('post_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();

            //tell the table that this is a foreign key if your database support it
            $table->foreign('post_id')->references('id')->on('posts'); // on('table name, not the Model')

            $table->integer('tag_id')->unsigned();
            //tell the table that this is a foreign key if your database support it
            $table->foreign('tag_id')->references('id')->on('tags'); // on('table name, not the Model')

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
