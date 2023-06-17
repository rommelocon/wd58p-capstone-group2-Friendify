<?php

namespace App\Models;

class Post extends BaseModel
{
    protected $fillable = [
        'user_id',
        'content',
        'image_path',
        'video_path',
        'likes_count',
        'comments_count',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isLikedBy($user)
    {
        return $this->likes()->where('likes.user_id', $user->id)->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function updateCommentsCount()
    {
        $this->comments_count = $this->comments()->count();
        $this->save();
    }

    public function shares()
    {
        return $this->hasMany(Share::class);
    }
}
