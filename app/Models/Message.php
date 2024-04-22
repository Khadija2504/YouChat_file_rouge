<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'from_id',
        'to_id',
        'chat_id',
    ];
    public function from_user(){
        return $this->belongsTo(User::class,'from_id');
    }
    public function to_user(){
        return $this->belongsTo(User::class,'to_id');
    }
    public function chat_room(){
        return $this->belongsTo(ChatRoom::class,'chat_id');
    }

}
