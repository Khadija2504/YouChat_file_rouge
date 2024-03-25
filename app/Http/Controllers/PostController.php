<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPhotos;
use App\Http\Requests\RequestPosts;
use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\photo;
use App\Models\photos_post;
use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function home(){
        $posts = Post::with('comments', 'users', 'postVotes', 'photos')->orderBy('created_at', 'desc')->get();
        // foreach($posts as $post){
        //     foreach($post->photos as $photo){
        //         dd($photo->images->photo);
        //     }
        // }
        return view('home', compact('posts'));
    }
    public function addPostsForm(){
        $user_id = Auth::user()->id;
        return view('posts.addPosts', compact('user_id'));
    }

    public function addPosts(RequestPosts $requestPost, RequestPhotos $requestPhotos){
        $validated = $requestPost->validated();
        $validatedPhotos = $requestPhotos->validated();
    
        $post = post::create($validated);
        $post_id = $post->id;
    
        if ($requestPhotos->hasFile('photo')) {
            $files = $requestPhotos->file('photo');
            foreach($files as $file){
                $file_name = time() . '_' . $file->getClientOriginalName();
                $path = 'imgs/';
                $file->move(public_path($path), $file_name);
                $photo = photo::create([
                    'photo' => $path . $file_name,
                ]);

                photos_post::create([
                    'photo_id' => $photo->id,
                    'post_id' => $post_id,
                ]);
            }
        }
        return redirect()->back()->with('add', 'seccessfully created');
    }

    public function updatePost(RequestPosts $request, $id){
        $validated = $request->validated();
        $post = post::where('id', $id);
        $post->update($validated);
        return redirect()->back()->with('updatePost', 'seccesfully updated');
    }
    public function deletePost($id){
        $post = post::where('id', $id);
        $comments = Comment::where('post_id', $id);
        $commentsPost = Comment::where('post_id', $id)->get();
        $votes = PostVote::where('post_id', $id);
        if(isset($votes)){
            $votes->delete();
        }
        foreach($commentsPost as $commentPost){
            $votesComments = CommentVote::where('comment_id', $commentPost->id);
            if(isset($votesComments)){
                $votesComments->delete();
            }
        }
        if(isset($comments)){
            $comments->delete();
        }
        $photosPivo = photos_post::where('post_id', $id);
        $photosPivoo = photos_post::where('post_id', $id)->get();
        if(isset($photosPivo)){
            $photosPivo->delete();
            foreach($photosPivoo as $photoPivos){
                $photo = photo::where('id', $photoPivos->photo_id);
                $photo->delete();
            }
        }
        $post->delete();
        return redirect()->back();
    }
}
