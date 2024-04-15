<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordLinkController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentVoteController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FriendsListController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostVoteController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VoteEventController;
use App\Http\Controllers\VoteVideoController;
use App\Models\photos_post;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth')->group(function () {
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/logout',[loginController::class, 'logout'])->name('logout');
});
Route::middleware('auth', 'user')->group(function () {
    Route::get('/home', [PostController::class, 'home'])->name('home');

    Route::get('/addForm', [PostController::class, 'addPostsForm'])->name('addPostsForm');
    Route::post('/addPost', [PostController::class, 'addPosts'])->name('addPosts');
    Route::get('/deletePost{id}', [PostController::class, 'deletePost'])->name('deletePost');
    Route::post('/updatePost{id}', [PostController::class, 'updatePost'])->name('updatePost');
    Route::delete('/deletePhoto{id}', [photos_post::class, 'deletePhoto'])->name('deletePhoto');

    Route::get('/addVideo/form', [VideoController::class, 'addVideoForm'])->name('addVideoForm');
    Route::post('/addVideo', [VideoController::class, 'addVideo'])->name('addVideo');
    Route::get('/display/Videos', [VideoController::class, 'displayReels'])->name('displayReels');
    Route::post('/video/vote{id}', [VoteVideoController::class, 'voteVideo'])->name('voteVideo');

    Route::get('/notifications', [NotificationController::class, 'notifications'])->name('notifications');
    Route::get('/notifications/readPost/{id}', [NotificationController::class,'readPost'])->name('readPost');
    Route::get('/notifications/readVideo/{id}', [NotificationController::class, 'readVideo'])->name('readVideo');

    Route::get('/post/vote/{id}', [PostVoteController::class, 'postVote'])->name('postVote');
    // Route::get('/vote/dislike/{id}', [PostVoteController::class, 'dislikePost'])->name('dislikePost');

    Route::get('/comment/vote/{id}', [CommentVoteController::class, 'commentVote'])->name('commentVote');
    // Route::get('/vote/dislikeComment/{id}', [CommentVoteController::class, 'dislikeComment'])->name('dislikeComment');

    Route::get('/follow{id}', [FriendsListController::class, 'follow'])->name('follow');
    Route::get('/follow/listFollowers', [FriendsListController::class, 'listFollowers'])->name('listFollowers');
    Route::post('/followers/acceptation{id}', [FriendsListController::class, 'acceptation'])->name('acceptation');

    Route::get('/followers/blocke{id}', [FriendsListController::class, 'blocke'])->name('blicke');

    Route::get('/favorites', [FavoriteController::class, 'favorites'])->name('favorites');
    Route::get('/favorites_posts', [FavoriteController::class, 'savedPosts'])->name('savedPosts');
    Route::get('/favorites_events', [FavoriteController::class, 'savedEvents'])->name('savedEvents');
    Route::get('/favorite{id}', [FavoriteController::class, 'favorite'])->name('favorite');

    Route::post('/addComment{id}', [CommentController::class, 'addComment'])->name('addComment');
    Route::get('/deleteComment{id}', [CommentController::class, 'deleteComment'])->name('deleteComment');

    Route::get('/event/createForm', [EventController::class, 'createForm'])->name('createForm');
    Route::post('/event/create', [EventController::class, 'createEvent'])->name('createEvent');
    Route::get('/event/display', [EventController::class, 'displayEvents'])->name('displayEvents');
    Route::post('/event/reactions/{id}', [VoteEventController::class, 'voteEvent'])->name('voteEvent');
    Route::get('/event/delete/{id}', [EventController::class, 'deleteEvent'])->name('deleteEvent');
    Route::post('/event/update{id}', [EventController::class, 'updateEvent'])->name('updateEvent');

    Route::get('/chatRoom', [ChatRoomController::class, 'chatRoom'])->name('chatRoom');
    Route::get('/chatRoom/conversations', [ChatRoomController::class, 'conversations'])->name('conversations');
    Route::post('/chatRoom/createMessage', [MessageController::class, 'addMessage'])->name('createMessage');
    Route::get('/chatRoom/displayMessages/{id}', [MessageController::class, 'displayMessages'])->name('displayMessages');
});

Route::get('/request', [ForgotPasswordLinkController::class, 'create'])->name('request');
Route::post('/requests', [ForgotPasswordLinkController::class, 'store']);
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset', [ForgotPasswordController::class, 'reset'])->name('reset');

Route::middleware('guest')->group(function () {
    Route::get('/register', [registerController::class, 'create'])->name('reister');
    Route::post('/storeRegister', [registerController::class,'store'])->name('storeRegister');

    Route::get('/login', [loginController::class, 'create'])->name('login');
    Route::post('/storeLogin', [loginController::class,'store'])->name('storeLogin');
});

// Route::get('/posts', [postsController::class, 'create'])->name('posts');