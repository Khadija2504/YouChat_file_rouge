<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPosts;
use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function home(){
        $posts = Post::with('comments', 'users', 'postVotes')->orderBy('created_at', 'desc')->get();
        // foreach($posts as $post){
        //     foreach($post->comments as $comment){
        //         dd($comment->commentVotes->where('vote', 'like')->count());
        //     }
        // }
        return view('home', compact('posts'));
    }
    public function addPostsForm(){
        $user_id = Auth::user()->id;
        return view('posts.addPosts', compact('user_id'));
    }

    public function addPosts(RequestPosts $request){
        $validated = $request->validated();
        // dd($request->hasFile('photo'));
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'imgs/photos/';
            $file->move($path, $file_name);
            $validated['photo'] = $path . '/' . $file_name;
        }
        post::create($validated);
        return redirect()->back()->with('add', 'seccessfully created');
    }

    public function editPostsForm($id){
        $posts = post::where('id', $id)->get();
        $user_id = Auth::user()->id;
        return view('posts.editPosts', compact('posts', 'user_id'));
    }

    public function editPosts(RequestPosts $request, $id){
        $validated = $request->validated();
        $post = post::where('id', $id);
        $post->update($validated);
        return redirect()->back()->with('updatePost', 'seccesfully updated');
    }
}
