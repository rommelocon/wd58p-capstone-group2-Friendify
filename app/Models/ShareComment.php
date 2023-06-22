<?php

namespace App\Models;

class ShareComment extends BaseModel
{
    protected $fillable = [
        'content',
        'user_id',
        'share_id',
    ];

    public function share()
    {
        return $this->belongsTo(Share::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($comment) {
            $comment->share->updateCommentsCount();
        });

        static::deleted(function ($comment) {
            $comment->share->updateCommentsCount();
        });
    }
}
