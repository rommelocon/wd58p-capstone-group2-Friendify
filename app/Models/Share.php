<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Share extends BaseModel
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id' /* other fillable fields */];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isLikedBy($user)
    {
        return $this->likes()->where('likes.user_id', $user->id)->exists();
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }
}
