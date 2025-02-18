<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'user_name',
        'contry',
        'city',
        'status',
        'acceptation',
        'about',
        'password',
    ];

    public function followers(){
        return $this->hasMany(FriendsList::class, 'user_id');
    }
    public function posts(){
        return $this->hasMany(Post::class, 'user_id');
    }
    public function videos(){
        return $this->hasMany(video::class, 'user_id');
    }
    public function reels(){
        return $this->hasMany(Reel::class, 'user_id');
    }
    public function events(){
        return $this->hasMany(Evenement::class, 'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'user_id');
    }
    public function friendChat(){
        return $this->hasMany(ChatRoom::class, 'friend_id');
    }
    public function usersChat(){
        return $this->hasMany(ChatRoom::class, 'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
