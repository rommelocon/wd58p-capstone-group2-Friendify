<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Result
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1>Search Results</h1>

                        @if ($results->isEmpty())
                        <p>No results found.</p>
                        @else
                        <ul>
                            @foreach ($results as $user)
                            <li class="flex items-center mb-4">
                                <x-profile-picture :profilePicture="$user->profilePicture" :userName="$user->name" />
                                <a href="{{ route('profile.index', $user->id) }}" class="text-blue-500 hover:text-blue-700">
                                    {{ $user->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>