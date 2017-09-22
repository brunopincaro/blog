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

/* AUTHENTICATION ROUTES */

// required using Laravel's AuthController
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm'] ); // form
Route::post('auth/login', 'Auth\LoginController@login'); // action when login form is submited
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout'] );

/* REGISTRATION ROUTES */
// required using Laravel's AuthController
Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm'] ); // register form
Route::post('auth/register', 'Auth\RegisterController@register'); // action to save the data to the DB

/* PASSWORD RESETS ROUTES */

// the form
// Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// we need to pass a token because Laravel adds it automatically to the url if the email address exists in the DB
// the ? means that we aren't always looking for a token in the url, it may or may not exist and the url will be valid; it is an optional field
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset'); // in laravel 5.4 we don't need the '?'

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset'); // the action for the reset form submit

/* CATEGORIES */
// Because we are using the Laravel's CRUD, we use the resource() method to automatically create all the necessary routes
Route::resource('categories', 'CategoryController', ['except' => ['create']]);
// 3rd parameter "except" : to tell Laravel not to create a "create" route, because the form will be in the "index" route
// or 3rd parameter "only" and list all the routes to be created

/* TAGS */
Route::resource('tags', 'TagController', ['except' => ['create']]);

/* PUBLIC ROUTES */

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
Route::post('contact', 'PagesController@postContact');

Route::get('/', 'PagesController@getIndex');

// Because we are using the Laravel's CRUD, we use the resource() method to automatically create all the necessary routes
Route::resource('posts', 'PostController');