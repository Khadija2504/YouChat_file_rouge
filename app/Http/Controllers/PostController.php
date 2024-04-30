<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPhotos;
use App\Http\Requests\RequestPosts;
use App\Http\Requests\SearchPost;
use App\Models\ChatRoom;
use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\Evenement;
use App\Models\favorite;
use App\Models\FriendsList;
use App\Models\Message;
use App\Models\Notification;
use App\Models\photo;
use App\Models\photos_post;
use App\Models\Post;
use App\Models\PostVote;
use App\Models\Reel;
use App\Models\Story;
use App\Models\User;
use App\Models\video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function home(){
        $followings = FriendsList::where('user_id', auth()->user()->id)->with('users')->get();
        $follow = FriendsList::where('user_id', auth()->user()->id)->first();
        $isFollowed = FriendsList::where('user_id', Auth::id())->first();
        $setStories = Story::where('user_id', Auth::user()->id)->where('created_at', '>=', Carbon::now()->subHours(24))->exists();
        $myStories = Story::where('user_id', Auth::user()->id)->where('created_at', '>=', Carbon::now()->subHours(24))
                            ->with(['users', 'votesStories'])->latest()->limit(4)->get();
        $conversations = ChatRoom::where('user_id', Auth::user()->id)->orWhere('friend_id', Auth::user()->id)
                                    ->with('friends', 'users', 'messages')->orderBy('created_at', 'desc')->get();
        $birthdays = [];
        $posts = [];
        $videoExtensions = ['mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv'];
        if(isset($follow->id)){
            foreach ($followings as $following){
                if($following->status == 'valid' && $following->blocked == 0 && $following->users->ban == 0){
                    $birthdays = Evenement::where('user_id', $following->friend_id)->with('users')->take(3)->orderBy('updated_at', 'desc')->get();
                    $posts = Post::with('comments', 'users', 'postVotes', 'photos', 'favorites')->orderBy('updated_at', 'desc')->take(6)->get();
                } else{
                    $birthdays = Evenement::where('user_id', auth()->user()->id)->with('users')->take(3)->orderBy('updated_at', 'desc')->get();
                    $posts = Post::where('user_id', auth()->user()->id)->with('comments', 'users', 'postVotes', 'photos')->orderBy('updated_at', 'desc')->take(6)->get();
                }
            }
        } else{
            $birthdays = Evenement::where('user_id', auth()->user()->id)->with('users')->take(3)->orderBy('updated_at', 'desc')->get();
            $posts = Post::where('user_id', auth()->user()->id)->with('comments', 'users', 'postVotes', 'photos', 'favorites')->orderBy('updated_at', 'desc')->take(6)->get();
        }
        // dd($birthdays);
        // foreach($posts as $post){
        //     foreach($post->comments as $comment){
        //         dd($comment->user_id == Auth::user()->id);
        //     }
        // }
        return view('home', compact('posts', 'follow', 'followings', 'isFollowed', 'setStories', 'myStories', 'videoExtensions', 'conversations', 'birthdays'));
    }

    public function displayMorePosts(Request $request) {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 6);
    
        $followings = FriendsList::where('user_id', auth()->user()->id)->with('users')->get();
        $follow = FriendsList::where('user_id', auth()->user()->id)->first();
        $isFollowed = FriendsList::where('user_id', Auth::id())->first();
        $setStories = Story::where('user_id', Auth::user()->id)->where('created_at', '>=', Carbon::now()->subHours(24))->exists();
        $myStories = Story::where('user_id', Auth::user()->id)->where('created_at', '>=', Carbon::now()->subHours(24))
                            ->with(['users', 'votesStories'])->latest()->limit(6)->get();
        $conversations = ChatRoom::where('user_id', Auth::user()->id)->orWhere('friend_id', Auth::user()->id)
                                    ->with('friends', 'users', 'messages')->orderBy('created_at', 'desc')->get();
        $post = [];
        $videoExtensions = ['mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv'];

        if(isset($follow->id)){
            foreach ($followings as $following){
                if($following->status == 'valid' && $following->blocked == 0 && $following->users->ban == 0){
                    $posts = Post::with('comments', 'users', 'postVotes', 'photos', 'favorites')->orderBy('created_at', 'desc')->skip($offset)->take($limit)->get();
                } else{
                    $posts = Post::where('user_id', auth()->user()->id)->with('comments', 'users', 'postVotes', 'photos')->orderBy('created_at', 'desc')->skip($offset)->take($limit)->get();
                }
            }
        } else{
            $posts = Post::where('user_id', auth()->user()->id)->with('comments', 'users', 'postVotes', 'photos', 'favorites')->orderBy('created_at', 'desc')->skip($offset)->take($limit)->get();
        }
    
        $html = view('posts.posts_partial', compact('posts', 'follow', 'followings', 'isFollowed', 'setStories', 'myStories', 'videoExtensions', 'conversations'))->render();
    
        return response()->json(['html' => $html, 'posts' => $posts]);
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

    public function updatePost(RequestPosts $request, requestPhotos $requestPhotos, $id){
        $validated = $request->validated();
        $post = post::where('id', $id);
        $post->update($validated);
        if ($requestPhotos->hasFile('photo')) {
            $files = $requestPhotos->file('photo');
            foreach($files as $file){
                $file_name = time() . '_' . $file->getClientOriginalName();
                $path = 'imgs/';
                $file->move(public_path($path), $file_name);
                // dd($file_name);
                $photo = photo::create([
                    'photo' => $path . $file_name,
                ]);

                photos_post::create([
                    'photo_id' => $photo->id,
                    'post_id' => $id,
                ]);
            }
        }
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
    public function search(SearchPost $request){
            $validator = $request->validated();
            $search = $validator['search'];
            $posts = Post::where('description', 'like', "%$search%")
                        ->with('comments', 'users', 'postVotes', 'photos', 'favorites')
                        ->orderBy('created_at', 'desc')->limit(4)->get();
            $users = User::where('name', 'like', "%$search%")->orderBy('created_at', 'desc')->limit(4)->get();
            $videos = video::where('titre', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->orderBy('created_at', 'desc')->limit(4)->get();
            $reels = Reel::where('description', 'like', "%$search%")->orderBy('created_at', 'desc')->limit(4)->get();
            $posts->transform(function($post){
                if($post->users){
                    $post->users->avatar_url = asset('' . $post->users->avatar);
                    $post->post_url = route('readPost', $post->id);
                }
                return $post;
            });
            $users->transform(function($user){
                if($user->avatar){
                    $user->avatar_url = asset('' . $user->avatar);
                    $user->user_url = route('profile', $user->id);
                }
                return $user;
            });
            $videos->transform(function ($video) {
                if ($video->video) {
                    $video->video_path = asset('' . $video->video);
                    $video->video_type = strtolower(pathinfo($video->video, PATHINFO_EXTENSION));
                    $video->video_url = route('readVideo', ['id' => $video->id]);
                }
                return $video;
            });
            $reels->transform(function ($reel) {
                if ($reel->reel) {
                    $reel->reel_path = asset('' . $reel->reel);
                    $reel->reel_type = strtolower(pathinfo($reel->reel, PATHINFO_EXTENSION));
                    $reel->reel_url = route('readReel', ['id' => $reel->id]);
                }
                return $reel;
            });
            
            return response()->json([
                'msg' => 'your result about' . ' ' . $search,
                'post' => $posts,
                'users' => $users,
                'videos' => $videos,
                'reels' => $reels,
            ]);
    }
    public function sharePost($postId, $conversationId){
        $post = Post::where('id', $postId)->first();
        $message = "<a href='http://127.0.0.1:8000/notifications/readPost/$postId'> $post->description </a>";
        $sendMessage = Message::create([
            'chat_id' => $conversationId,
            'from_id' => Auth::user()->id,
            'to_id' => Auth::user()->id,
            'message' => $message,
        ]);
        return response()->json([
            'msg' => 'post share successful',
            'success' => true,
            'sendMessage' => $sendMessage,
        ]);
    }

    public function searchConversations(Request $request)
{
    $search = $request->search;
    $user_id = Auth::user()->id;

    $chat_rooms = ChatRoom::where('user_id', $user_id)
        ->orWhere('friend_id', $user_id)
        ->with(['friends', 'users', 'messages'])
        ->orderBy('created_at', 'desc')
        ->get();

    $conversations = collect();

    foreach ($chat_rooms as $chat) {
        $other_user_id = ($chat->user_id == $user_id) ? $chat->friend_id : $chat->user_id;
        $other_user = User::find($other_user_id);

        if ($other_user->name == $search || strpos($other_user->email, $search) !== false) {
            $conversations->push([
                'chat_room_id' => $chat->id,
                'user' => $other_user
            ]);
        }
    }

    $conversations->transform(function ($conversation) {
        $conversation['user']->avatar_url = asset($conversation['user']->avatar);
        return $conversation;
    });

    return response()->json([
        'msg' => 'Conversations displayed successfully',
        'conversations' => $conversations,
    ]);
}
}
