<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'user_id',
        'post_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function commentVotes(){
        return $this->hasMany(CommentVote::class);
    }
}