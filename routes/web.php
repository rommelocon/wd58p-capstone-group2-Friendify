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
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\ShareCommentController;
use App\Http\Controllers\ShareReactionController;

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
    return view('auth/login');
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
    Route::match(['GET', 'POST'], '/home', [HomeController::class, 'index'])->name('home');
    Route::get('/friend', [FriendController::class, 'index'])->name('friend.index');
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
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

// Share a post
Route::post('/posts/share', [ShareController::class, 'create'])->name('posts.share');

// Reaction routes
Route::post('/posts/{post}/like', [ReactionController::class, 'update']);
Route::post('/posts/{post}/unlike', [ReactionController::class, 'remove']);
Route::post('/shares/{share}/like', [ShareReactionController::class, 'update']);
Route::post('/shares/{share}/unlike', [ShareReactionController::class, 'remove']);

// Retrieve comments for a post (GET request)
Route::get('/posts/{post}/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('/posts/{share}/shared-comments', [ShareCommentController::class, 'index'])->name('share-comments.index');


// Create a new comment for a post (POST request)
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/posts/{share}/shared-comments', [ShareCommentController::class, 'store'])->name('share-comments.store');

// Route to display the privacy setting view
Route::get('/privacy', [PrivacyController::class, 'index'])->name('privacy.index');

// Route to handle the privacy update request
Route::put('/posts/{postId}/privacy', [PrivacyController::class, 'update'])->name('posts.privacy.update');
Route::put('/share/{postId}/privacy', [PrivacyController::class, 'shareUpdate'])->name('shares.privacy.update');


require __DIR__ . '/auth.php';
