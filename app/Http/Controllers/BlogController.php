<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    // To get all posts / archive
    public function getIndex() {
        $posts = Post::paginate(10);

        return view('blog.index')->withPosts($posts);
    }

    // To get a single blog post

        // the var name parameter on the method should correspond to the one on the route : 'blog/{slug}'
    
        // you should also respect the the parameters order : blog/{slug}/{id} ->  getSingle($slug, $id)
    
    public function getSingle($slug) {

    	// fetch from the database based on slug

    	// as the slug is a unique field in the database, we know that from the previous query will only come one result, so we can use first() (single post object)instead of get() (collection post object), and will speed also the query as it will stop after the first query result

    	// get() will retrieve an object with all the posts

    	$post = Post::where('slug', '=', $slug)->first();

    	// return the view and pass in the post object
    	return view('blog.single')->withPost($post);
    }
}
