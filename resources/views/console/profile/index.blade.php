<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <div class="flex items-center">
                        <x-profile-picture :profilePicture="$user->profilePicture" :width="48" />
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
                            <div class="flex">
                                @foreach ($user->friends as $friend)
                                <x-profile-picture :profilePicture="$friend->profilePicture" :mr="0" />
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <!-- Add any other personal information you want to display -->
                </div>

                <div class="p-6 bg-white">
                    <div class="mt-8">
                        @if (auth()->user()->id !== $user->id)
                        @if (!auth()->user()->friends->contains($user))
                        @if (auth()->user()->pendingFriendsTo->contains($user))
                        <p>Friend request successfully sent.</p>
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

            </div>
        </div>
    </div>
</x-app-layout>