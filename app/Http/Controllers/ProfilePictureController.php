<?php

namespace App\Http\Controllers;

use App\Models\ProfilePicture;
use App\Http\Requests\StoreProfilePictureRequest;
use App\Http\Requests\UpdateProfilePictureRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilePictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreProfilePictureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfilePicture $profilePicture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = auth()->user();
        $profilePicture = $user->profilePicture;

        return view('profile.picture.edit', compact('user', 'profilePicture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $request->user();

        // Store the uploaded image in the storage folder
        $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');

        // Create or update the user's profile picture path in the profile_pictures table
        $profilePicture = $user->profilePicture ?? new ProfilePicture();
        $profilePicture->user_id = $user->id;
        $profilePicture->image_path = $imagePath;
        $profilePicture->save();

        return redirect()->route('profile.edit')->with('success', 'Profile picture updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $profilePicture = $user->profilePicture;

        if ($profilePicture) {
            // Delete the profile picture file from storage
            Storage::disk('public')->delete($profilePicture->image_path);

            // Delete the profile picture record
            $profilePicture->delete();

            return redirect()->back()->with('success', 'Profile picture deleted successfully.');
        }

        return redirect()->back()->with('error', 'No profile picture found.');
    }
}
