<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    use HasFactory;
    protected $fillable = [
        'video',
        'user_id',
        'titre',
        'description',
    ];
    public function videoVotes(){
        return $this->hasMany(vote_video::class);
    }
}
