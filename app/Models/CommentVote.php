<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentVote extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'vote',
        'comment_id',
    ];
}
