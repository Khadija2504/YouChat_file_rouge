<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evenement extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'date',
        'user_id',
        'image',
        'category_id',
        'status',
    ];
    public function voteEvent(){
        return $this->hasMany(VoteEvent::class, 'evenement_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
