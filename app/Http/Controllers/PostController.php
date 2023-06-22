<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Share;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4|max:100000',
            'privacy' => 'nullable|in:public,friends,private', // Validate privacy setting
        ]);

        $post = new Post();
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        $post->privacy = $request->input('privacy', 'public'); // Set default to 'public' if not specified

        // Handle image upload (if provided)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('post_images', 'public');
            $post->image_path = $imagePath;
        }

        // Handle video upload (if provided)
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoPath = $video->store('post_videos', 'public');
            $post->video_path = $videoPath;
        }

        $post->save();

        return redirect()->back()->with('success', 'Post created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
