<?php

namespace App\Http\Controllers;

use App\Models\Post;


class ReactionController extends Controller
{
    public function update(Post $post)
    {
        $user = auth()->user();

        if ($post->isLikedBy($user)) {
            $post->likes()->detach($user->id);
            $post->decrement('likes_count');

            return response()->json([
                'success' => true,
                'is_liked' => false,
                'likes_count' => $post->likes_count,
            ]);
        } else {
            $post->likes()->attach($user->id);
            $post->increment('likes_count');

            return response()->json([
                'success' => true,
                'is_liked' => true,
                'likes_count' => $post->likes_count,
            ]);
        }
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
