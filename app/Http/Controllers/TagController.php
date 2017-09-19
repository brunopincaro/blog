<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag; // use the tag model
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
