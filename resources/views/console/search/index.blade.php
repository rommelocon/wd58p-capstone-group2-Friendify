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
                    <div class="p-4">
                        <form action="{{ route('search.index') }}" method="GET" class="flex items-center">
                            <input type="text" name="query" placeholder="Search" class="px-3 py-2 rounded-l-md border border-gray-300 focus:outline-none focus:border-indigo-500 flex-grow" />
                            <button type="submit" class="px-4 py-2 rounded-r-md bg-indigo-500 text-white hover:bg-indigo-600">Search</button>
                        </form>
                    </div>
                    <div class="container">
                        @if (isset($results) && $results->isNotEmpty())
                        <h1>Search Results</h1>
                        <ul>
                            @foreach ($results as $user)
                            <li class="flex items-center mb-4">
                                <x-profile-picture :profilePicture="$user->profilePicture" :userName="$user->name" :userId="$user->id" />
                                <a href="{{ route('profile.index', $user->id) }}" class="text-blue-500 hover:text-blue-700">
                                    {{ $user->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @elseif (isset($results) && $results->isEmpty())
                        <p>No results found.</p>
                        @elseif (!isset($results))
                        <p>Enter a search query to see results.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>