<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['photo_name', 'photo_desc', 'upload_date', 'image_path', 'album_id', 'id'];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Like()
    {
        return $this->hasMany(Like::class, 'photo_id');
    }
    public function Comment()
    {
        return $this->hasMany(Comment::class, 'photo_id');
    }
    public function Album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}
