<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <!-- Add any other personal information you want to display -->

                    <h3 class="text-lg font-semibold mt-8 mb-4">Profile Picture</h3>
                    <div class="profile-picture">
                        @if ($user->profilePicture)
                        <img class="w-40 h-40 rounded-full" src="{{ asset('storage/' . $user->profilePicture->image_path) }}" alt="Profile Picture">
                        @else
                        <img class="w-40 h-40 rounded-full" src="{{ asset('storage/default-profile-photo.png') }}" alt="Default Profile Picture">
                        @endif
                    </div>

                    <!-- Add any other sections or information you want to display -->

                    <div class="mt-8">
                        @if (auth()->user()->id !== $user->id && !auth()->user()->friends->contains($user))
                        <form action="{{ route('addFriend', $user) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Add Friend
                            </button>
                        </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>