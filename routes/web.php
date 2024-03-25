<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordLinkController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentVoteController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostVoteController;
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
    Route::post('/addPosts', [PostController::class, 'addPosts'])->name('addPosts');
    Route::get('/deletePost{id}', [PostController::class, 'deletePost'])->name('deletePost');
    Route::post('/updatePost{id}', [PostController::class, 'updatePost'])->name('updatePost');
    Route::delete('/deletePhoto{id}', [photos_post::class, 'deletePhoto'])->name('deletePhoto');

    Route::get('/vote/like/{id}', [PostVoteController::class, 'likePost'])->name('likePost');
    Route::get('/vote/dislike/{id}', [PostVoteController::class, 'dislikePost'])->name('dislikePost');

    Route::get('/vote/likeComment/{id}', [CommentVoteController::class, 'likeComment'])->name('likeComment');
    Route::get('/vote/dislikeComment/{id}', [CommentVoteController::class, 'dislikeComment'])->name('dislikeComment');

    Route::get('/favorites', [FavoriteController::class, 'favorites'])->name('favorites');
    Route::get('/favorites_posts', [FavoriteController::class, 'savedPosts'])->name('savedPosts');
    Route::get('/favorites_events', [FavoriteController::class, 'savedEvents'])->name('savedEvents');
    Route::get('/favorite{id}', [FavoriteController::class, 'favorite'])->name('favorite');

    Route::post('/addComment{id}', [CommentController::class, 'addComment'])->name('addComment');
    Route::get('/deleteComment{id}', [CommentController::class, 'deleteComment'])->name('deleteComment');
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