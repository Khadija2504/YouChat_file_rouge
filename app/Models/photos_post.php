<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class photos_post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'photo_id',
        'post_id',
    ];
    public function images(){
        return $this->belongsTo(photo::class, 'photo_id');
    }
}
