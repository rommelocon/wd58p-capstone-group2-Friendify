<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post->comments()->paginate(3);

        return view('comments.index', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->post_id = $post->id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        // Update the comments_count for the associated post
        $post->updateCommentsCount();

        return redirect()->back();
    }
}
