<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comments', 'upload_date', 'photo_id', 'user_id','parent_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'asc');
    }
    public function Photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }
}
