<?php 

/* This controller will deal with all static pages */

namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {
	// every page is going to be an action, and each action is a function

	public function getIndex() {
		// A controller it
			# process variable data or params
			# talk to the model
			# recieve from the model/database table
			# compile or precess the data again from model if needed
			# pass the dqtq to the correct view

		//return "Index page";

        $posts = Post::orderBy('created_at', 'desc')->take(4)->get(); // just by using Post:: instead of DB::, we are using the same as DB::select('*')->table('posts'), because the controller Post is already linked to the table posts

		return view('pages.home')->withPosts($posts);
	}

	public function getAbout() {
		$first = 'Bruno';
		$last = 'Pincaro';

		$full = $first . " " . $last;
		$email = "brunopincaro@gmail.com";
		
		$data = [];
		$data['email'] = $email;
		$data['fullname'] = $full;

		//return view('pages.about')->with("fullname", $full);
		//return view('pages.about')->withFullname( $full )->withEmail( $email );
		return view('pages.about')->withData( $data );
	}

	public function getContact() {
		return view('pages.contact');
	}
}
?>