<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Using only the view model
-------------------------

Route::get('contact', function () {
    return view('contact');
});
*/

/*
Using the MVC model
-------------------
*/

// route for showing posts publically
// create a blog controller to deal with all the posts and comments : php artisan make:controller BlogController
// we need to secure the data retrieved through 'slug', so we need to tell laravel to only go to the controller if the, in this case, {slug} matches certains parameters : Route::get(...)->where('slug', 'validation rules')
	// see regular expresions
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+'); // single post
	// [] : defines a group
	// \w : from word, meaning only characters
	// \d : digit, only numbers
	// \- : -, the dash character
	// \_ : _, the underline character
	// + : however many after the previous rule

	// for example, to define a user name trhough the url, /@username, the regular expression would be : @[\w\d\-\_]+
Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']); // posts archive / list of posts
Route::get('about', 'PagesController@getAbout');

Route::get('contact', 'PagesController@getContact');

Route::get('/', 'PagesController@getIndex');

Route::resource('posts', 'PostController');