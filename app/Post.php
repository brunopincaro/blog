<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Define the relashionship with Category controller
    // The post will belong to a category : 1 post has 1 category
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
