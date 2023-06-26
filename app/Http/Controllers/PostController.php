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
            'file' => 'nullable|file|image|mimes:jpeg,png,gif,webp,mp4|max:10000', // Adjust the allowed file types and maximum size as per your requirements
            'privacy' => 'nullable|in:public,friends,private', // Validate privacy setting
        ]);

        $post = new Post();
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        $post->privacy = $request->input('privacy', 'public'); // Set default to 'public' if not specified

        // Handle file upload (if provided)
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('post_files', 'public');

            // Determine the file type based on MIME type
            $fileType = $file->getClientMimeType();
            if (strpos($fileType, 'image') !== false) {
                $post->image_path = $filePath;
            } elseif (strpos($fileType, 'video') !== false) {
                $post->video_path = $filePath;
            }
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
