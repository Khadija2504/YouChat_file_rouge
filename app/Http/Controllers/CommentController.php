<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment(Request $request, $id){
        $request->validate([
            'description' => 'required',
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'description' => $request->description,
        ]);
        return redirect()->back();
    }
}
