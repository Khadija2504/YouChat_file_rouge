<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images_event extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_id',
        'event_id',
    ];
}
