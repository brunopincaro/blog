<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddSlugToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function ($table) {
            $table->string('slug')->unique()->after('body'); // when using unique() it will automatically assign the column as indexed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // as we add a column to a table, we are not going to delete the table, but remove the column 'slug'
        Schema::table('posts', function ($table){
            $table->dropColumn('slug');

            // if columns created on the up() method were created with index(['slug', 'title']), for example, we would need to unindex them when dropping it : dropIndex()
        });
    }
}
