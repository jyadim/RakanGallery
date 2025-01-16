<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
