<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag; // use the tag model
use App\Post; // use the post model
use Session;

class TagController extends Controller
{
    // only authenticated users can access this functionalities
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show all the tags
        $tags = Tag::all();
        return view('tags.index')->withTags($tags);

        // form to create a new tag

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation rules
        $this->validate($request, array(
            'name' => 'required|min:3|max:255'
        ));

        // create an object to store the form data
        $tag = new Tag;
        $tag->name = $request->name;

        // save to the DB
        $tag->save();

        // show the success message
        Session::flash('success', 'New tag added!');

        // redirect the user
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // list all post for that tag
        $tag = Tag::find($id);

        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('tags.edit')->withTag($tag);
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
        $tag = Tag::find($id);

        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $tag->name = $request->name;

        $tag->save();

        Session::flash('success', 'Tag successfully changed.');

        return redirect()->route('tags.show', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the tag to delete by id
        $tag = Tag::find($id);

        // remove the many-to-many relationship taht was set up previously with posts
        // need to reference posts so that Laravel knows what relationship to detach : to reference the Post model "->posts()"
        $tag->posts()->detach();

        $tag->delete();

        Session::flash('success', 'Tag successfully deleted!');

        return redirect()->route('tags.index');    }
}
