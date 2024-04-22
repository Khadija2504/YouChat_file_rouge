<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'data_Story',
        'comment',
        'status',
    ];
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function votesStories(){
        return $this->hasMany(stories_vote::class, 'story_id');
    }
}
