<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['album_name', 'desc', 'uploaded_at', 'id', 'slug'];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Photo()
    {
        return $this->hasMany(Photo::class, 'album_id');
    }
}
