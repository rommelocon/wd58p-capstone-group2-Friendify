<?php

namespace App\Models;

class Share extends BaseModel
{
    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'likes_count',
        'comments_count',
        'privacy',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(ShareComment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }

    public function share_likes()
    {
        return $this->belongsToMany(Share::class, 'share_likes', 'user_id', 'share_id');
    }

    public function isLikedBy($user)
    {
        return $this->share_likes()->where('share_likes.user_id', $user->id)->exists();
    }

    public function updateCommentsCount()
    {
        $this->comments_count = $this->comments()->count();
        $this->save();
    }

    public function getPostImageAttribute()
    {
        return $this->post->postImage;
    }

    public function getUserProfilePictureAttribute()
    {
        return $this->post->userProfilePicture;
    }

    public function getUserNameAttribute()
    {
        return $this->post->userName;
    }

    public function getCreatedAtFormattedAttribute()
    {
        return $this->post->createdAtFormatted;
    }

    public function getTextContentAttribute()
    {
        return $this->post->textContent;
    }

    public function getPostVideoAttribute()
    {
        return $this->post->postVideo;
    }
}
