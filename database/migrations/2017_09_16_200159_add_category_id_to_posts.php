<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('category_id')->nullable()->after('slug')->unsigned();
            // create the column "category_id" in the "Posts" table
            // nullable() makes it optional, in case you forget to add a category
            // after() tells laravel to create the column after the one selected in after
            // unsigned() is very important, it means that the integer will not have a sign "+" or "-" (will only be positive meaning no sign will be showned)

            // $table->foreign('categories_id')->references('id')->on('categories');
                // will rely on DB to do the relations but not every database supports this type of manually encoding, like InnoDB, so it doesn't do anything with this code
                // we'll set this relations by hardcoding them and set the relationships with php instead on relying on the DB, it's safer
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
}
