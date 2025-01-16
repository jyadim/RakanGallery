<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [''];
    public function User()
    {
        return $this->belongsTo(User::class, 'id');
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
