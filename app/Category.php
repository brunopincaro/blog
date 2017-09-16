<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /* 
    //	We will overwrite here what got extended in the Model
    */

    // Manually tell this model "Category" to use the "categories" table
    // normally it isn't needed, but is best when using a table name that is out of the Laravel convention were the controller name is the same as the table name
    protected $table = 'categories'; // The table name "categories" is sligtly different from the controller name "Category"

    // Define the relationship
    // one category is going to have many posts
    public function posts()
    {
    	return $this->hasMany('App\Post'); // in hasMany() we tell it the model it should connect to
    }
}
