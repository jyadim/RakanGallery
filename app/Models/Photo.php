<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function 
}
