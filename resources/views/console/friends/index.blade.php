<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}'s Friends
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-4 m-5">
            <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900">
                    <h1 class="text-xl font-bold mb-4">Friend List</h1>
                    @if ($friends->count() > 0)
                    <ul>
                        @foreach ($friends as $friend)
                        <li class="mb-2 flex justify-between items-center">

                            <div class="flex items-center">
                                <x-profile-picture :profilePicture="$friend->profilePicture" :userName="$friend->name" :userId="$friend->id" />

                                <a href="{{ route('profile.index', $friend->id) }}" class="text-blue-500 hover:text-blue-700">
                                    {{ $friend->name }}
                                </a>
                            </div>

                            <form action="{{ route('removeFriend', $friend) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                    Remove Friend
                                </button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>No friends found.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4">Friend Requests:</h3>
                    @if (Auth::user()->pendingFriendsFrom->count() > 0)
                    <div class="friend-requests">
                        <ul>
                            @foreach (Auth::user()->pendingFriendsFrom as $friend)
                            <li class="mb-4 flex justify-between items-center">
                                <div class="flex items-center">
                                    <x-profile-picture :profilePicture="$friend->profilePicture" :userName="$friend->name" :userId="$friend->id" />

                                    <a href="{{ route('profile.index', $friend->id) }}" class="text-blue-500 hover:text-blue-700">
                                        {{ $friend->name }}
                                    </a>
                                </div>

                                <div class="flex space-x-1 mt-2">
                                    <form action="{{ route('acceptFriendRequest', $friend) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">Accept</button>
                                    </form>
                                    <form action="{{ route('removeFriendRequest', $friend) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">Remove</button>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                    <p class="italic">No friend requests.</p>
                    @endif

                    @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 mt-4 rounded" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>

                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4">Sent Friend Requests:</h3>
                    @if (Auth::user()->pendingFriendsTo->count() > 0)
                    <div class="friend-requests">
                        <ul>
                            @foreach (Auth::user()->pendingFriendsTo as $friend)
                            <li class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <x-profile-picture :profilePicture="$friend->profilePicture" :userName="$friend->name" :userId="$friend->id" />

                                    <a href="{{ route('profile.index', $friend->id) }}" class="text-blue-500 hover:text-blue-700">
                                        {{ $friend->name }}
                                    </a>
                                </div>

                                <div class="flex space-x-4 mt-2">
                                    <form action="{{ route('cancelFriendRequest', $friend) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">Cancel</button>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 mt-4 rounded" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    @else
                    <p class="italic">No friend requests.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


</x-app-layout>