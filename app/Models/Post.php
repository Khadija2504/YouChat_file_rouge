<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'titre',
        'description',
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
    public function photos(){
        return $this->hasMany(photos_post::class);
    }

    public function favorites(){
        return $this->hasMany(favorite::class, 'post_id');
    }

}