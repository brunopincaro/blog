<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // user name that commented
            $table->string('email'); // user email
            $table->text('comment');
            $table->boolean('approved'); // comment approved or not
            $table->integer('post_id')->unsigned();
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            // when working with foreign keys, if you use the onDelete() method, you don't need to use detach()
            // detach() is better for when dealing with pivot tables (many-to-many relationships), which is not the case here
            // "cascade" means that if the post is deleted, the comments associated will also be deleted
        });


        /*
        
        //If not using the unsigned() to the 'post_id'

        Schema::table('comments', function ($table) {
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        }

        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // should drop the foreign key before droping the table
        // dropForeign needs to be called under Schema::table with a Blueprint object
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });
        
        Schema::dropIfExists('comments');
    }
}
