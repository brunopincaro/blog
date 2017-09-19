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

    //access the tags from inside our posts
    //the tags that belong to the post
    public function tags()
    {
    	return $this->belongsToMany('App\Tag'); //need to create the inverse in the Tag Model so this could function

    	//we're following the Laravel convention :

    	// the code generated automatically by Laravel
    	// belongsToMany('App\Post', 'post_tag', 'post_id', 'tag_id');

    	//because we're in the Post Model, the model_id would be the column "post_id"
    }
}
