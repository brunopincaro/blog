<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;
use Session;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id) // need to read the post_id passed through the view form
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|min:5|max:2000'
        ]);

        $post = Post::find($post_id); // to associate this comment to the post

        $comment = new Comment;

        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post); // where post() is the method post() in the Comment.php model

        $comment->save();

        Session::flash('success', 'Your comment was successfully added.');

        return redirect()->route('blog.single', [$post->slug]); // because the route 'blog.index' returns an URL in the form blog/{slug}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);

        return view('comments.edit')->withComment($comment);
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
        $comment = Comment::find($id);

        $this->validate($request, array(
            'comment' => 'required|min:5|max:2000'
        ));

        $comment->comment = $request->comment;

        $comment->save();

        Session::flash('success', 'Comment updated.');

        return redirect()->route('posts.show', $comment->post->id);
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        return view('comments.delete')->withComment($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        // need to store the post id as it will be deleted and we are still going to need it in the return
        $postId = $comment->post->id;

        $comment->delete();

        Session::flash('success', 'Comment succesfully deleted.');

        return redirect()->route('posts.show', $postId);
    }
}
