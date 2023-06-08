<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('posts.store') }}" class="mb-4">
                        @csrf
                        <div class="flex items-center mb-2">
                            <x-profile-picture :profilePicture="Auth::user()->profilePicture" />

                            <textarea name="content" placeholder="Write your post..." rows="4" class="w-full rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <div class="flex justify-end mt-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg px-4 py-2">Post</button>
                        </div>
                    </form>

                    <div class="posts">
                        @forelse($posts as $post)
                        <div class="post bg-white rounded-lg shadow-md p-4 mb-4">
                            <div class="flex items-center mb-2">

                                <x-profile-picture :profilePicture="$post->user->profilePicture" />

                                <h3 class="text-lg font-semibold">{{ $post->user->name }}</h3>
                            </div>
                            <p class="text-gray-800">{{ $post->content }}</p>
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