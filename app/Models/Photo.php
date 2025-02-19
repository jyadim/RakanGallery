<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['photo_name', 'photo_desc', 'upload_date', 'image_path', 'album_id',  'slug'];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'photo_id')->latest();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'photo_id')->latest();
    }
    public function Album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}
