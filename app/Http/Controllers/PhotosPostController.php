<?php

namespace App\Http\Controllers;

use App\Models\photos_post;
use Illuminate\Http\Request;

class PhotosPostController extends Controller
{
    public function deletePhoto($id){
        $photo_post = photos_post::find($id);
        $photo_post->delete();
        return redirect()->back();
    }
}
