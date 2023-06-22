<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Models\ShareComment;
use Illuminate\Http\Request;

class ShareCommentController extends Controller
{
    public function index(Share $share)
    {
        $share_comments = $share->share_comments;

        return view('share-comments.index', [
            'share' => $share,
            'comments' => $share_comments,
        ]);
    }

    public function store(Request $request, Share $share)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $share_comments = new ShareComment();
        $share_comments->content = $validatedData['content'];
        $share_comments->share_id = $share->id;
        $share_comments->user_id = auth()->user()->id;
        $share_comments->save();

        // Update the comments_count for the associated share
        $share->updateCommentsCount();

        return redirect()->back();
    }
}
