<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //access the posts from inside our tags
    //the posts that belong to the tag
    public function posts()
    {
    	return $this->belongsToMany('App\Post'); //need to create the inverse in the Post Model so this could function

    	//we're following the Laravel convention :

    	// the code generated automatically by Laravel
    	// belongsToMany('App\Post', 'post_tag', 'tag_id', 'post_id');

    	//because we're in the Tag Model, the model_id would be the column "tag_id"
    }
}
