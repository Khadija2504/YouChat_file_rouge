<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'photo',
        'user_id',
    ];
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function postVotes(){
        return $this->hasMany(PostVote::class);
    }
}
