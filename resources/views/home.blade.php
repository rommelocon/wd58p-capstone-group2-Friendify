<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- User Input for posting content -->
                    <div class="flex items-center mb-2">
                        <!-- <x-profile-picture :profilePicture="Auth::user()->profilePicture" /> -->
                        <div class="w-12 h-12 rounded-full mr-2 object-cover overflow-hidden">
                            <img src="{{Auth::user()->profilePicture ? asset('storage/' . Auth::user()->profilePicture->image_path) : asset('storage/default-profile-photo.png') }}" alt="{{ Auth::user()->profilePicture ? 'Profile Picture' : 'Default Profile Picture' }}" class="w-full h-full">
                        </div>

                        <button class="textarea-button" id="modal-toggle">
                            Write your post...
                        </button>

                        <div id="post-modal" class="modal hidden">
                            <div class="modal-content">
                                <!-- Modal content goes here -->
                                <x-post-modal />
                            </div>
                        </div>
                    </div>

                    <!-- User Posts -->
                    <div class="posts">
                        @forelse($posts as $post)
                        <div class="post bg-white rounded-lg shadow-md p-4 mb-4">
                            <div class="flex items-center mb-2">
                                <!-- User post profile picture -->
                                <div class="w-12 h-12 rounded-full mr-2 object-cover overflow-hidden">
                                    <img src="{{ Auth::user()->profilePicture ? asset('storage/' . Auth::user()->profilePicture->image_path) : asset('storage/default-profile-photo.png') }}" alt="{{ Auth::user()->profilePicture ? 'Profile Picture' : 'Default Profile Picture' }}" class="w-full h-full">
                                </div>
                                <h3 class="text-lg font-semibold">{{ $post->user->name }}</h3>
                            </div>
                            <p class="text-gray-800">{{ $post->content }}</p>

                            <!-- Display image if available -->
                            @if ($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="w-full mt-4">
                            @endif

                            <!-- Display video if available -->
                            @if ($post->video_path)
                            <video controls class="w-full mt-4">
                                <source src="{{ asset('storage/' . $post->video_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            @endif

                            <div class="flex items-center mt-2">
                                <div class="flex items-center text-gray-600 mr-4">
                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                    </svg>
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 18l6-6-6-6"></path>
                                    </svg>
                                    <span>Comments {{ $post->comments_count }}</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 18l6-6-6-6"></path>
                                    </svg>
                                    <span>Likes {{ $post->likes_count }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500">No posts available.</p>
                        @endforelse
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>