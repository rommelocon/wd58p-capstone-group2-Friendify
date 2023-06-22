<div class="p-6 text-gray-900">
    <!-- User Input for posting content -->
    @if (Auth::user()->id === $user->id)
    <div class="flex items-center mb-2">
        <x-profile-picture :profilePicture="$user->profilePicture" :userName="$user->name" />
        <x-post-modal title="Post Modal" />
    </div>
    @endif

    <!-- User Posts -->
    <div class="posts">
        @if ($index->isEmpty())
        <!-- Display message for no posts available -->
        <p class="text-gray-500">No posts available.</p>
        @else
        @foreach ($index as $item)
        @if ($item instanceof App\Models\Post)
        <!-- Display post data -->
        @if ($item->privacy === 'public')
        <!-- Display the post -->
        <div class="post rounded-lg shadow-md py-4 mb-4 border">
            <!-- Post content -->
            <x-post :user="$user" :item="$item" />
        </div>
        @elseif ($item->privacy === 'friends' && ($user->friends($item->user)->exists() || $user->id === $item->user_id))
        <!-- Display the post -->
        <div class="post rounded-lg shadow-md py-4 mb-4 border">
            <!-- Post content -->
            <x-post :user="$user" :item="$item" />
        </div>
        @elseif ($item->privacy === 'private' && $user->id === $item->user_id)
        <!-- Display the post -->
        <div class="post rounded-lg shadow-md py-4 mb-4 border">
            <!-- Post content -->
            <x-post :user="$user" :item="$item" />
        </div>
        @endif
        @elseif ($item instanceof App\Models\Share)
        <!-- Display shared post data -->
        @if ($item->post->privacy === 'public')
        <!-- Display the shared post -->
        <div class="post rounded-lg shadow-md py-4 mb-4 border">
            <!-- Shared post content -->
            <x-shared-post :user="$user" :item="$item" />
        </div>
        @elseif ($item->post->privacy === 'friends' && $user->friendsTo($item->post->user))
        <!-- Display the shared post -->
        <div class="post rounded-lg shadow-md py-4 mb-4 border">
            <!-- Shared post content -->
            <x-shared-post :user="$user" :item="$item" />
        </div>
        @elseif ($item->post->privacy === 'private' && $user->id === $item->post->user_id)
        <!-- Display the shared post -->
        <div class="post rounded-lg shadow-md py-4 mb-4 border">
            <!-- Shared post content -->
            <x-shared-post :user="$user" :item="$item" />
        </div>
        @endif
        @endif
        @endforeach
        @endif
    </div>
</div>