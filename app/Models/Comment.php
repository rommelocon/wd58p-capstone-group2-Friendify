<?php

namespace App\Models;

class Comment extends BaseModel
{
    protected $fillable = ['content'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($comment) {
            $comment->post->updateCommentsCount();
        });

        static::deleted(function ($comment) {
            $comment->post->updateCommentsCount();
        });
    }
}
