<?php

namespace App\Http\Controllers;

use App\Models\favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function savedPosts(){
        $saved = favorite::where('user_id', Auth::user()->id)->with('posts')->get();
        // dd($saved->posts);
        return view('posts.savedPosts', compact('saved'));
    }
    public function favorite($id){
        $favorite = favorite::where('user_id', Auth::user()->id)->where('post_id', $id)->first();
        if(!isset($favorite)){
            favorite::create([
                'user_id' => Auth::user()->id,  
                'post_id' => $id,
            ]);
            return response()->json([
                'success' => true,
                'favorite' => $favorite,
            ]);
        } else{
            $favorite->delete();
            return response()->json([
                'success' => false,
                'msg' => 'deleted successfully',
            ]);
        }
    }
}
