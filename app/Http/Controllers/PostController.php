<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Session;

class PostController extends Controller
{
    // Only give access to Authenticated users, no guests
    public function __construct() {
        $this->middleware('auth', ['except' => '']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all the blog posts for the logged in user

        // store all the blogposts in a variable

        // $posts = Post::all();
        $posts = Post::orderBy('id', 'desc')->paginate(10); // this will show the newer posts first

        // return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // find all the categories and store it in a variable
        $categories = Category::all();

        // we're just going to show the form to create the post
        // pass the $categories object to the view
        return view('posts.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // works as a post request, and pulls all the data from the $request

        // validate the data
        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:64|unique:posts,slug', // alpha_dash : field under validation may have alpha-numeric characters, as well as dashes and underscores
                'category_id' => 'required|integer',
                'body'  => 'required',
            ));

        // All the code from this point on will only run if the validation() succeeds, else, it will run the create()

        // store in the database
        $post = new Post; //we need to tell our controller where to get the Post model : use App\Post

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;

        $post->save();

        Session::flash('success', 'Post successfully saved!');

        return redirect()->route('posts.show', $post->id); // redirect the user

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find the post by this $id in the database
        $post = Post::find($id); // we use our Post model and find() that only accepts the primary id as property

        // pass it to the view so we can display it to the user
        // the $id is passed from the route

        //return view('posts.show')->with('post', $post);
        //or
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post in the database
        $post = Post::find($id);

        //pull the categories
        $categories = Category::all();
        // to use the Form::select() helper in the edit post view
        // need to create an array in the form array('id' => 'name'), where id and name are the columns from the table Categories which were used in the form in the create view : <option value="{{ $category->id }}">{{ $category->name }}</option>
        $cats = [];
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        // return the view and pass that data
        return view('posts.edit')->withPost($post)->withCategories($cats);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data before use it

        // check if slug has changed
        $post = Post::find($id);

        if ( $request->input('slug') == $post->slug ) {
            $this->validate($request, array(
                'title' => 'required|max:255',
                'category_id' => 'required|integer',
                'body' => 'required',
            ));
        } else {
            $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:64|unique:posts,slug',
                'category_id' => 'required|integer',
                'body' => 'required',
            ));
        }

        // Save the data to the database
        $post = Post::find($id); // find the post by id to update

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = $request->input('body');

        $post->save();

        // Set flash data with success message
        Session::flash('success', 'Post successfully updated!');

        // Redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the post to delete by id
        $post = Post::find($id);

        $post->delete();

        Session::flash('success', 'Post successfully deleted!');

        return redirect()->route('posts.index');
    }
}
