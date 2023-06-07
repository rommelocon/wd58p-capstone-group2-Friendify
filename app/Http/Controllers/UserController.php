<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function addFriend(User $user)
    {
        $friend = auth()->user();

        $user->friends()->attach($friend);

        return redirect()->back()->with('success', 'Friend added successfully.');
    }

    public function showProfile(User $user)
    {
        return view('console.profile.index', compact('user'));
    }
}
