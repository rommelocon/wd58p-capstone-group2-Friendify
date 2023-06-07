<div class="px-4">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search" class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-indigo-500" />
        <button type="submit" class="ml-2 px-4 py-2 rounded-md bg-indigo-500 text-white hover:bg-indigo-600">Search</button>
    </form>
</div>