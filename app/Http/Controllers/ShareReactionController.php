<?php

namespace App\Http\Controllers;

use App\Models\Share;

class ShareReactionController extends Controller
{
    public function update(Share $share)
    {
        $user = auth()->user();

        if ($share->shareIsLikedBy($user)) {
            $share->share_likes()->detach($user->id);
            $share->decrement('likes_count');

            return response()->json([
                'success' => true,
                'is_liked' => false,
                'likes_count' => $share->likes_count,
            ]);
        } else {
            $share->share_likes()->attach($user->id);
            $share->increment('likes_count');

            return response()->json([
                'success' => true,
                'is_liked' => true,
                'likes_count' => $share->likes_count,
            ]);
        }
    }

    public function remove(Share $share)
    {
        $user = auth()->user();

        if ($share->shareIsLikedBy($user)) {
            $share->share_likes()->detach($user->id);
            $share->decrement('likes_count');
        }

        return response()->json([
            'success' => true,
            'is_liked' => false,
            'likes_count' => $share->likes_count,
        ]);
    }
}
