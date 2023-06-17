<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $friends = $user->friends()->with('profilePicture')->get();

        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $acceptedFriendIds = $user->acceptedFriendsFrom->pluck('id')->merge($user->acceptedFriendsTo->pluck('id'))->push($user->id);

            $posts = Post::whereIn('user_id', $acceptedFriendIds)
                ->with('user')
                ->latest()
                ->paginate(10);

            return view('console.profile.index', compact('posts', 'user'));
        }

        // Handle the case when the user is not authenticated
        return view('console.profile.index', compact('user', 'friends'));
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
