<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\Share;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfileController extends Controller
{
    public function index($id)
    {
        if (Auth::check()) {
            $user = User::find($id);
            $acceptedFriendIds = $user->friends->pluck('id')->push($user->id);

            $userPost = Post::where('user_id', $user->id) // Retrieve posts where the user ID matches the owner's ID
                ->with('user')
                ->latest()
                ->get();

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
            $posts = new LengthAwarePaginator($slice, $feed->count(), $perPage, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
            ]);

            return view('console.profile.index', compact('posts', 'user', 'feed', 'userPost'));
        }
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
