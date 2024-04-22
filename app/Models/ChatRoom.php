<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'friend_id',
    ];
    public function friends(){
        return $this->belongsTo(User::class, 'friend_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function messages(){
        return $this->hasMany(Message::class, 'chat_id');
    }
}
