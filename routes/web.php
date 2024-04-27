<?php

use App\Http\Controllers\adminBoard;
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
use App\Http\Controllers\googleAuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PhotosPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostVoteController;
use App\Http\Controllers\ReelController;
use App\Http\Controllers\ReelVoteController;
use App\Http\Controllers\StoriesVoteController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VoteEventController;
use App\Http\Controllers\VoteVideoController;
use App\Models\Message;
use App\Models\Notification;
use App\Models\photos_post;
use App\Models\Reel_vote;
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
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::middleware('auth')->group(function () {

Route::get('/logout',[loginController::class, 'logout'])->name('logout');
});
Route::middleware('auth', 'user')->group(function () {
    Route::get('/home', [PostController::class, 'home'])->name('home');

    Route::get('/addForm', [PostController::class, 'addPostsForm'])->name('addPostsForm');
    Route::post('/addPost', [PostController::class, 'addPosts'])->name('addPosts');
    Route::get('/deletePost{id}', [PostController::class, 'deletePost'])->name('deletePost');
    Route::post('/updatePost{id}', [PostController::class, 'updatePost'])->name('updatePost');
    Route::get('/deletePhoto/{id}', [PhotosPostController::class, 'deletePhoto'])->name('deletePhoto');
    Route::get('/share/post/{postId}/{conversationId}', [PostController::class, 'sharePost'])->name('sharePost');
    Route::post('/searchConversations', [PostController::class, 'searchConversations'])->name('searchConversations');

    Route::get('/addVideo/form', [VideoController::class, 'addVideoForm'])->name('addVideoForm');
    Route::post('/addVideo', [VideoController::class, 'addVideo'])->name('addVideo');
    Route::get('/display/Videos', [VideoController::class, 'displayVideos'])->name('displayVideos');
    Route::post('/video/vote/{id}', [VoteVideoController::class, 'voteVideo'])->name('voteVideo');
    Route::get('/video/delete/{id}', [VoteVideoController::class, 'deleteVideo'])->name('deleteVideo');

    Route::get('/displayReels', [ReelController::class, 'displayReels'])->name('displayReels');
    Route::get('/reels/addForm', [ReelController::class, 'addForm'])->name('addForm');
    Route::post('/reels/addReel', [ReelController::class, 'addReel'])->name('addReel');
    Route::get('/reels/vote/{id}', [ReelVoteController::class, 'voteReel'])->name('voteReel');
    Route::get('/reels/delete/{id}', [ReelController::class, 'deleteReel'])->name('deleteReel');

    Route::get('/notifications', [NotificationController::class, 'notifications'])->name('notifications');
    Route::get('/notifications/readPost/{id}', [NotificationController::class,'readPost'])->name('readPost');
    Route::get('/notifications/readVideo/{id}', [NotificationController::class, 'readVideo'])->name('readVideo');
    Route::get('/notifications/readReel/{id}', [NotificationController::class, 'readreel'])->name('readReel');

    Route::get('/post/vote/{id}', [PostVoteController::class, 'postVote'])->name('postVote');
    // Route::get('/vote/dislike/{id}', [PostVoteController::class, 'dislikePost'])->name('dislikePost');

    Route::get('/comment/vote/{id}', [CommentVoteController::class, 'commentVote'])->name('commentVote');
    // Route::get('/vote/dislikeComment/{id}', [CommentVoteController::class, 'dislikeComment'])->name('dislikeComment');

    Route::get('/follow/{id}', [FriendsListController::class, 'follow'])->name('follow');
    Route::get('/followers/listFollowers', [FriendsListController::class, 'listFollowers'])->name('listFollowers');
    Route::post('/followers/acceptation{id}', [FriendsListController::class, 'acceptation'])->name('acceptation');

    Route::get('/unfollow/{id}', [FriendsListController::class, 'unfollow'])->name('unfollow');
    Route::get('/followers/block/{id}', [FriendsListController::class, 'block'])->name('block');

    Route::get('/profile/{id}', [FriendsListController::class, 'profile'])->name('profile');
    Route::get('/profile/share/{userId}/{conversationId}', [FriendsListController::class, 'shareProfile'])->name('share.profile');

    Route::get('/favorites', [FavoriteController::class, 'favorites'])->name('favorites');
    Route::get('/favorites_posts', [FavoriteController::class, 'savedPosts'])->name('savedPosts');
    Route::get('/favorites_events', [FavoriteController::class, 'savedEvents'])->name('savedEvents');
    Route::get('/favorite/{id}', [FavoriteController::class, 'favorite'])->name('favorite');

    Route::post('/addComment{id}', [CommentController::class, 'addComment'])->name('addComment');
    Route::get('/deleteComment/{id}', [CommentController::class, 'deleteComment'])->name('deleteComment');

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
    Route::get('/chatRoom/DeleteMessage/{id}', [MessageController::class, 'deleteMessage'])->name('deleteMessage');
    Route::get('/createConversation/{id}', [ChatRoomController::class, 'createconversation'])->name('createconversation');
    Route::get('/conversations/unreadMessages', [ChatRoomController::class, 'unreadMessages']);
    Route::get('/messages/unreadConversations', [MessageController::class, 'unreadConversations']);

    Route::post('/stories/addStory', [StoryController::class, 'addStory'])->name('addStory');
    Route::get('/stories/displayFriendStories/{id}', [StoryController::class, 'displayFriendStories'])->name('displayFriendStories');
    Route::get('/stories/displayStories/{id}', [StoryController::class, 'displayStories'])->name('displayStories');
    Route::get('/stories/displayAvatarStories', [StoryController::class, 'displayAvatarStories'])->name('displayAvatarStories');
    Route::get('/stories/votesStory/{id}', [StoriesVoteController::class, 'votesStory']);
    Route::get('/stories/deleteStory/{id}', [StoriesVoteController::class, 'deleteStory'])->name('deleteStory');

    Route::get('/redirect_back', [ReelController::class, 'redirectBack'])->name('redirectBack');
    
    Route::get('/notifications/unread', [NotificationController::class, 'unreadNotifications']);
});

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/dashboard', [adminBoard::class, 'dashboard'])->name('dashboard');
    Route::get('/banner/{id}', [adminBoard::class, 'banner'])->name('banner');
    Route::get('/admin/usersList', [adminBoard::class, 'usersList'])->name('usersList');
    Route::get('/admin/users/profile/{id}', [adminBoard::class, 'profileUser'])->name('profileUser');
});
    Route::post('/searchUsers', [adminBoard::class, 'searchUsers'])->name('searchUsers');

Route::post('/search', [PostController::class, 'search'])->name('search');

Route::get('/request', [ForgotPasswordLinkController::class, 'create'])->name('request');
Route::post('/requests', [ForgotPasswordLinkController::class, 'store']);
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset', [ForgotPasswordController::class, 'reset'])->name('reset');

Route::middleware('guest')->group(function () {
    Route::get('/register', [registerController::class, 'create'])->name('reister');
    Route::post('/storeRegister', [registerController::class,'storeRegister'])->name('storeRegister');

    Route::get('/Forget-password', [ForgotPasswordController::class, 'Forget'])->name('forget.password');
    Route::post('/Forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('forget');
    Route::get('/reset-password/{token}' , [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');
    Route::post('/reset-password' , [ForgotPasswordController::class, 'ResetPasswordPost'])->name('reset.password.post');

    Route::get('/login', [loginController::class, 'create'])->name('login');
    Route::post('/storeLogin', [loginController::class,'store'])->name('storeLogin');

    Route::get('/auth/google/utilisateur', [googleAuthController::class, 'redirect'])->name('googleAuthentication');
    Route::get('/auth/google/call-back', [googleAuthController::class, 'handleGoogleCallback'])->name('googleAuthenticationCallback');
});

// Route::get('/posts', [postsController::class, 'create'])->name('posts');