<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

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
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

// Profile picture routes
Route::get('/profile/picture', [ProfilePictureController::class, 'edit'])->name('profile.picture.edit');
Route::post('/profile/picture', [ProfilePictureController::class, 'update'])->name('profile.picture.update');
Route::delete('/profile/picture', [ProfilePictureController::class, 'destroy'])->name('profile.picture.delete');

Route::post('/users/{user}/add-friend', [UserController::class, 'addFriend'])->name('addFriend');
Route::get('/users/{user}', [UserController::class, 'showProfile'])->name('users.showProfile');
Route::get('/users/{id}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/search', [SearchController::class, 'search'])->name('search');


require __DIR__ . '/auth.php';
