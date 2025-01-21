<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'like';
    protected $fillable = ['like_date', 'photo_id', 'user_id'];
    public function User()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
