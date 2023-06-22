<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center">

                        <x-profile-picture :profilePicture="$user->profilePicture" :userName="$user->name" class="big-picture" />

                        <div>
                            <p class="text-4xl font-black">{{ $user->name }}</p>
                            <p class="text-gray-700">
                                {{ $user->friends()->count() }}
                                @if ($user->friends()->count() === 1)
                                friend
                                @else
                                friends
                                @endif
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="mt-2">
                            @if (auth()->user()->id !== $user->id)
                            @if (!auth()->user()->friends->contains($user))
                            @if (auth()->user()->pendingFriendsTo->contains($user))
                            <form action="{{ route('cancelFriendRequest', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                    Cancel Friend Request
                                </button>
                            </form>
                            @else
                            <form action="{{ route('addFriend', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                    Add Friend
                                </button>
                            </form>
                            @endif
                            @else
                            <form action="{{ route('removeFriend', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                    Remove Friend
                                </button>
                            </form>
                            @endif
                            @endif
                        </div>
                    </div>
                    <!-- Add any other personal information you want to display -->
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white flex items-center justify-between">
                    <div class="w-full grid grid-cols-3 gap-4">

                        <div>
                            <div class="mb-2">
                                <h3 class="font-bold text-lg">Photos</h3>
                                @if ($posts->isEmpty())
                                <!-- Display message for no posts available -->
                                <p class="text-gray-500">No photo available.</p>
                                @else
                                <div class="grid grid-cols-3 gap-2 mt-2">
                                    @foreach($posts as $post)
                                    <!-- Display image if available -->
                                    @if ($post->image_path)
                                    <div class="bg-gray-100 overflow-hidden">
                                        <div class="relative" style="padding-bottom: 100%;">
                                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="absolute inset-0 w-full h-full object-cover object-center">
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="mb-2">
                                <h3 class="font-bold text-lg">Videos</h3>
                                @if ($posts->isEmpty())
                                <!-- Display message for no posts available -->
                                <p class="text-gray-500">No video available.</p>
                                @else
                                <div class="grid grid-cols-3 gap-2 mt-2">
                                    @foreach($posts as $post)
                                    <!-- Display image if available -->
                                    @if ($post->video_path)
                                    <div class="bg-gray-100 overflow-hidden">
                                        <div class="relative" style="padding-bottom: 100%;">
                                            <video src="{{ asset('storage/' . $post->video_path) }}" alt="Post Video" class="absolute inset-0 w-full h-full object-cover object-center"></video>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-span-2">
                            <x-post-container :index="$userPost" :user="$user" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>