<?php

namespace App\Models;

class Post extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
