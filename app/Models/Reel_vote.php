<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reel_vote extends Model
{
    use HasFactory;
    protected $fillable = [
        'reel_id',
        'user_id',
        'voted',
    ];
}