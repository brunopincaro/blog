<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category; // without this namespace, it would be looking for this class inside of itself 'App\Http\Controllers' when this class is declared in 'App\Category'
use Session;

class CategoryController extends Controller
{
    // Prevent not logged in users from access this functionalities
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
        // create the object in wich to store the categories and pull all categories from database
        $categories = Category::all();

        // display a view and pass it all of our categories
        return view('categories.index')->withCategories($categories); // need create a route for this view in routes/web.php

        // form to create a new category
    }

    // will not be needing the create() method as the form will be showned on index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save a new category and redirect back to index()
        $this->validate($request, array(
            'name' => 'required|max:255'
        ));

        $category = new Category;

        $category->name = $request->name;

        $category->save();

        Session::flash('success', 'New category added!');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
