<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Share;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Post $post)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $acceptedFriendIds = $user->friends->pluck('id')->push($user->id);

            $posts = Post::whereIn('user_id', $acceptedFriendIds)
                ->with('user')
                ->latest()
                ->get();

            $sharedPosts = Share::whereIn('user_id', $acceptedFriendIds)
                ->with('post.user') // Include the user information of the original post
                ->latest()
                ->get();

            // Merge the posts and shared posts into a single collection
            $feed = $posts->concat($sharedPosts)->sortByDesc('created_at');

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 10;
            $slice = $feed->slice(($currentPage - 1) * $perPage, $perPage);
            $feed = new LengthAwarePaginator($slice, $feed->count(), $perPage, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
            ]);

            return view('home', compact('posts', 'user', 'feed'));
        }

        return redirect()->route('login');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeRequest $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
