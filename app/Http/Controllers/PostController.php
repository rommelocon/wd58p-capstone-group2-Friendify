<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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
            'content' => 'required|string|max:255', // Allow text
            'image' => 'nullable|image|max:2048', // Allow image uploads (optional)
            'video' => 'nullable|mimes:mp4|max:100000', // Allow video uploads (optional)
            // 'link' => 'nullable|url', // Allow link input (optional)
        ]);

        $post = new Post();
        $post->content = $request->input('content');
        $post->user_id = Auth::id();

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

        // // Handle link input (if provided)
        // if ($request->has('link')) {
        //     $post->link = $request->input('link');
        // }

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
