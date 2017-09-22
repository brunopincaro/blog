<?php 

/* This controller will deal with all static pages */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Mail;
use Session;

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

	public function postContact(Request $request) { // need to namespace Request at te top
		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3|max:255',
			'message' => 'required|min:10|max:200'
		]);

		$email = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'msg' =>$request->message // the word 'message' is reserved to Laravel's mailing system, need to choose another one like 'msg'
		);

		// Put the fields in the email
		// https://laravel.com/docs/5.4/mail

		// Don't forget to namespace Mail : use Illuminate\Support\Facades\Mail;
		// Mail::queue(); // if sending lots of emails
		
		// send('view', $data, function() { //will contain all the header information for the email : to, from, ... })
		Mail::send('emails.contact', $email, function( $message ) use ($email) {
			$message->from($email['email']);
			$message->to('brunopraia@gmail.com');
			$message->subject($email['subject']);
		});

		// to pass data to a function "use($dataToPass)"

		// Laravel will create a variable with the name of every 'key' in the $email array
		// In the view, will access te values by using this variables that Laravel created, instead of using $email['email'], ...
		// In case in the array 'msg' => ['q1' => 'hello', 'q2' => 'world'], we would reference in the view with $msg['q1'], $msg['q2'], ...

		Session::flash('success', 'Your message was sent.');

		// return redirect()->url('/');
		return redirect('/'); // Laravel 5.4
	}
}
?>