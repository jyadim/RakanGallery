<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function photo()
    {
        return $this->hasMany(Photo::class, 'album_id');
    }
}
