<?php

namespace App\Models;

class Friend extends BaseModel
{
    public function profilePicture()
    {
        return $this->belongsTo(ProfilePicture::class);
    }
}
