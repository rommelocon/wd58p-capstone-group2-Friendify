<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ReactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Navigation
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/friend', [FriendController::class, 'index'])->name('friend.index');
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');
});

// Profile picture routes
Route::get('/profile/picture', [ProfilePictureController::class, 'edit'])->name('profile.picture.edit');
Route::post('/profile/picture', [ProfilePictureController::class, 'update'])->name('profile.picture.update');
Route::delete('/profile/picture', [ProfilePictureController::class, 'destroy'])->name('profile.picture.delete');

// Friend request routes
Route::post('/profile/{user}/add-friend', [FriendRequestController::class, 'addFriend'])->name('addFriend');
Route::delete('/profile/{user}/remove-friend', [FriendRequestController::class, 'removeFriend'])->name('removeFriend');
Route::post('/profile/{sender}/accept-friend-request', [FriendRequestController::class, 'acceptFriendRequest'])->name('acceptFriendRequest');
Route::post('/profile/{sender}/remove-friend-request', [FriendRequestController::class, 'removeFriendRequest'])->name('removeFriendRequest');
Route::delete('/profile/{user}/cancel-friend-request', [FriendRequestController::class, 'cancelFriendRequest'])->name('cancelFriendRequest');

Route::post('/posts/{post}/like', [ReactionController::class, 'update']);
Route::post('/posts/{post}/unlike', [ReactionController::class, 'remove']);

// Retrieve comments for a post (GET request)
Route::get('/posts/{post}/comments', [CommentController::class, 'index'])->name('comments.index');

// Create a new comment for a post (POST request)
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/search', [SearchController::class, 'search'])->name('search');


require __DIR__ . '/auth.php';
