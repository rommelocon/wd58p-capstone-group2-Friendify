<?php

namespace App\Http\Controllers;

use App\Models\Post;

class ReactionController extends Controller
{
    public function update(Post $post)
    {
        $user = auth()->user();

        $isLiked = $post->isLikedBy($user);

        if ($isLiked) {
            $post->likes()->detach($user->id);
            $post->decrement('likes_count');
        } else {
            $post->likes()->attach($user->id);
            $post->increment('likes_count');
        }

        $isLiked = !$isLiked; // Invert the isLiked value to reflect the updated state

        return response()->json([
            'success' => true,
            'is_liked' => $isLiked,
            'likes_count' => $post->likes_count,
        ]);
    }

    public function remove(Post $post)
    {
        $user = auth()->user();

        if ($post->isLikedBy($user)) {
            $post->likes()->detach($user->id);
            $post->decrement('likes_count');
        }

        return response()->json([
            'success' => true,
            'is_liked' => false,
            'likes_count' => $post->likes_count,
        ]);
    }
}
