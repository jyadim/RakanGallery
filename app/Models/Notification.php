<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
   
        protected $fillable = ['notifiable_type', 'notifiable_id', 'type', 'data', 'read_at'];
    
        // Relasi ke User (jika notifikasi dikirim ke user)
        public function notifiable()
        {
            return $this->morphTo();
        }
    }
    

