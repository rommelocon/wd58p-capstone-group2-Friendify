@props(['feed', 'posts', 'user'])

<div class="p-6 text-gray-900">
    <!-- User Input for posting content -->
    <div class="flex items-center mb-2">
        <x-profile-picture :profilePicture="$user->profilePicture" :userName="$user->name" />
        <x-post-modal title="Post Modal" />
    </div>

    <!-- User Posts -->
    <div class="posts">
        @foreach ($feed as $item)
        @if ($item instanceof App\Models\Post)
        <!-- Display post data -->
        <div class="post rounded-lg shadow-md p-4 mb-4 border">
            <!-- Original Post Content -->
            <div class="original-post">
                <div class="flex items-center mb-2">
                    <!-- User post profile picture -->
                    <x-profile-picture :profilePicture="$item->user->profilePicture" :userName="$item->user->name" />
                    <div class="flex flex-col">
                        <h3 class="text-lg font-semibold">{{ $item->user->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $item->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <p class="text-gray-800 font-medium text-md leading-7">{{ $item->content }}</p>
                <!-- Display image if available -->
                @if ($item->image_path)
                <div class="w-full bg-gray-100 overflow-hidden">
                    <div class="h-[800px] mx-auto">
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="Post Image" class="w-full h-full object-cover object-top">
                    </div>
                </div>
                @endif
                <!-- Display video if available -->
                @if ($item->video_path)
                <div class="w-full bg-gray-900 overflow-hidden">
                    <div class="h-[800px] mx-auto">
                        <video controls class="w-full mt-4 h-full">
                            <source src="{{ asset('storage/' . $item->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                @endif
            </div>

            <div class="items-center justify-center text-center mt-2 grid grid-cols-3 border-t-2">
                <!-- Like button -->
                <form method="POST">
                    @csrf
                    <button id="reaction-btn" class="flex items-center justify-center text-center p-2 likeButton w-full hover:bg-gray-100" data-post-id="{{ $item->id }}">
                        <span class="like-icon">
                            @if ($item->isLikedBy(auth()->user()))
                            <i class="fa-solid fa-heart h-5 w-5 text-red-500 mr-1"></i>
                            @else
                            <i class="fa-regular fa-heart h-5 w-5 text-black mr-1"></i>
                            @endif
                        </span>
                        <span id="likeCount-{{ $item->id }}" class="text-gray-800">{{ $item->likes_count }}</span>
                    </button>
                </form>

                <div>
                    <!-- Comment button -->
                    <button class="flex items-center justify-center text-center p-2 commentButton w-full hover:bg-gray-100">
                        <i class="fa-regular fa-comment h-5 w-5 text-black mr-1"></i>
                        <span class="text-gray-800">{{ $item->comments_count }}</span>
                    </button>
                </div>

                <!-- Share button -->
                <form action="{{ route('posts.share') }}" method="POST" class="share-form">
                    @csrf
                    <input type="hidden" name="original_post_id" value="{{ $item->id }}">
                    <button type="submit" class="flex items-center justify-center text-center p-2 w-full hover:bg-gray-100">
                        <i class="fa-solid fa-share h-5 w-5 text-black mr-1"></i>
                        <span class="text-gray-800">{{ $item->shares_count }}</span>
                    </button>
                </form>
            </div>

            <div class="items-center justify-center text-center mt-2 border-t-2">
                <!-- Comment form -->
                <form method="POST" action="{{ route('comments.store', ['post' => $item]) }}" class="mt-2">
                    @csrf
                    <div class="flex items-center">
                        <input type="text" name="content" placeholder="Write a comment..." class="flex-grow px-4 py-2 border rounded-lg border-gray-200 rounded-e-none">
                        <button type="submit" class="px-4 py-[10px] border border-l-0 border-gray-200 text-white rounded-lg rounded-s-none">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                <path d="M18.0693 8.50867L9.50929 4.22867C3.75929 1.34867 1.39929 3.70867 4.27929 9.45867L5.14929 11.1987C5.39929 11.7087 5.39929 12.2987 5.14929 12.8087L4.27929 14.5387C1.39929 20.2887 3.74929 22.6487 9.50929 19.7687L18.0693 15.4887C21.9093 13.5687 21.9093 10.4287 18.0693 8.50867ZM14.8393 12.7487H9.43929C9.02929 12.7487 8.68929 12.4087 8.68929 11.9987C8.68929 11.5887 9.02929 11.2487 9.43929 11.2487H14.8393C15.2493 11.2487 15.5893 11.5887 15.5893 11.9987C15.5893 12.4087 15.2493 12.7487 14.8393 12.7487Z" fill="#292D32" />
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Display comments -->
                <div class="mt-2">
                    @foreach ($item->comments as $comment)
                    <div class="flex items-center">
                        <x-profile-picture :profilePicture="$comment->user->profilePicture" :userName="$comment->user->name" />
                        <div class="bg-gray-100 w-full p-2 text-left rounded-lg">
                            <h3 class="text-sm font-bold">{{ $comment->user->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $comment->content }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <x-pagination :paginator="$posts" />
</div>
</div>