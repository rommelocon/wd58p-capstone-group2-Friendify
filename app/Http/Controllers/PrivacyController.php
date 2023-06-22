<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivacyController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        return view('components.privacy-setting', compact('user'));
    }

    public function update(Request $request, $postId)
    {
        $selectedOption = $request->input('privacy');

        $post = Post::findOrFail($postId);
        $post->privacy = $selectedOption;
        $post->save();

        return response()->json(['message' => 'Privacy updated successfully']);
    }

    public function shareUpdate(Request $request, $postId)
    {
        $selectedOption = $request->input('privacy');

        $share = Share::findOrFail($postId);
        $share->privacy = $selectedOption;
        $share->save();

        return response()->json(['message' => 'Privacy updated successfully']);
    }
}
