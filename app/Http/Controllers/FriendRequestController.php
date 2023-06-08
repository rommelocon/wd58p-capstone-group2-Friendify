<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFriendRequestRequest;
use App\Http\Requests\UpdateFriendRequestRequest;
use App\Models\User;
use App\Notifications\FriendRequest;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    public function removeFriend(User $friend, Request $request)
    {
        $user = auth()->user();

        $request->user()->friendsTo()->detach($friend->id);
        $request->user()->friendsFrom()->detach($friend->id);

        return back()->with('success', 'Friend removed successfully.');
    }

    public function addFriend(Request $request, User $user)
    {
        // Check if the authenticated user is not the same as the user being added as a friend
        if ($request->user()->id !== $user->id) {
            // Create a new entry in the friendships pivot table
            $request->user()->friendsTo()->attach($user->id, ['accepted' => false]);

            return back()->with('success', 'Friend Request Sent');
        }

        return back()->with('error', 'Invalid friend request');
    }

    public function acceptFriendRequest(User $sender)
    {
        $user = auth()->user();

        // Accept the friend request
        $user->friendsFrom()->updateExistingPivot($sender->id, ['accepted' => true]);

        // Optionally, you can send a notification to the sender indicating that the friend request has been accepted.
        // Notification::send($sender, new FriendRequest($user));

        // Remove the friend request from the sender's pending requests
        $sender->pendingFriendsTo()->detach($user->id);

        return back()->with('success', 'Friend Request Accepted');
    }

    public function removeFriendRequest(User $sender)
    {
        $user = auth()->user();

        // Remove the friend request
        $user->friendsFrom()->detach($sender->id);

        return back();
    }

    public function cancelFriendRequest(User $sender)
    {
        $user = auth()->user();

        // Remove the friend request
        $user->friendsTo()->detach($sender->id);

        return back();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(StoreFriendRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FriendRequest $friendRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FriendRequest $friendRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFriendRequestRequest $request, FriendRequest $friendRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FriendRequest $friendRequest)
    {
        //
    }
}
