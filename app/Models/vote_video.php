<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vote_video extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'video_id',
        'vote',
    ];
}
