<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareController extends Controller
{
    public function create(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Retrieve the original post ID from the request data
        $originalPostId = $request->input('original_post_id');

        // Find the original post
        $originalPost = Post::find($originalPostId);

        // Create a new share entry
        $share = new Share();
        $share->user_id = $user->id;
        $share->post_id = $originalPost->id;
        $share->content = $originalPost->content;
        $share->save();

        // Increment the shares_count of the original post
        $originalPost->increment('shares_count');

        // Return a response indicating success
        return response()->json(['message' => 'Post shared successfully']);
    }
}
