<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'message',
        'sender_id',
        'type',
        'data_id',
    ];
    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
}
