<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- User Input for posting content -->
                    <div class="flex items-center mb-2">

                        <x-profile-picture :profilePicture="$user->profilePicture" :userName="$user->name" />

                        <x-post-modal title="Post Modal" />
                    </div>
                    <!-- User Posts -->
                    <div class="posts">
                        @forelse($posts as $post)
                        <div class="post rounded-lg shadow-md p-4 mb-4 border">
                            <div class="flex items-center mb-2">

                                <!-- User post profile picture -->
                                <x-profile-picture :profilePicture="$post->user->profilePicture" :userName="$post->user->name" />

                                <div class="flex flex-col">
                                    <h3 class="text-lg font-semibold">{{ $post->user->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <p class="text-gray-800 font-medium text-md leading-7">{{ $post->content }}</p>
                            <!-- Display image if available -->
                            @if ($post->image_path)
                            <div class="w-full h-[800px] bg-gray-100 overflow-hidden">
                                <div class=" mx-auto">
                                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="w-full h-full object-cover object-top">
                                </div>
                            </div>

                            @endif

                            <!-- Display video if available -->
                            @if ($post->video_path)
                            <div class="w-full bg-gray-900 overflow-hidden">
                                <div class="h-[800px] mx-auto">
                                    <video controls class="w-full mt-4 h-full">
                                        <source src="{{ asset('storage/' . $post->video_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                            @endif

                            <div class="items-center justify-center text-center mt-2 grid grid-cols-2 border-t-2">
                                <form method="POST">
                                    @csrf
                                    <button id="reaction-btn" class="flex items-center justify-center text-center p-2 likeButton w-full hover:bg-gray-100" data-post-id="{{ $post->id }}">
                                        <span class="like-icon">
                                            @if ($post->isLikedBy(auth()->user()))
                                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1">
                                                <path d="M3,21a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H6V21ZM19.949,10H14.178V5c0-2-3.076-2-3.076-2s0,4-1.026,5C9.52,8.543,8.669,10.348,8,11V21H18.644a2.036,2.036,0,0,0,2.017-1.642l1.3-7A2.015,2.015,0,0,0,19.949,10Z" />
                                            </svg>
                                            @else
                                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="none" class="h-5 w-5 text-blue-500 mr-1">
                                                <path d="M2,22H18.644a3.036,3.036,0,0,0,3-2.459l1.305-7a2.962,2.962,0,0,0-.637-2.439A3.064,3.064,0,0,0,19.949,9H15.178V5c0-2.061-2.113-3-4.076-3a1,1,0,0,0-1,1c0,1.907-.34,3.91-.724,4.284L6.593,10H2a1,1,0,0,0-1,1V21A1,1,0,0,0,2,22ZM8,11.421l2.774-2.7c.93-.907,1.212-3.112,1.3-4.584.542.129,1.109.38,1.109.868v5a1,1,0,0,0,1,1h5.771a1.067,1.067,0,0,1,.824.38.958.958,0,0,1,.21.8l-1.3,7A1.036,1.036,0,0,1,18.644,20H8ZM3,12H6v8H3Z" />
                                            </svg>
                                            @endif
                                        </span>
                                        <span id="likeCount-{{ $post->id }}" class="text-gray-800">{{ $post->likes_count }}</span>
                                    </button>
                                </form>

                                <div>
                                    <button class="flex items-center justify-center text-center p-2 likeButton w-full hover:bg-gray-100">
                                        <x-bx-comment class="h-5 w-5 text-blue-500 mr-1" /> <!-- Blade UI Kit comment icon -->
                                        <span class="text-gray-800">{{$post->comments_count}}</span>
                                    </button>
                                </div>
                            </div>

                            <div class="items-center justify-center text-center mt-2 border-t-2">
                                <form method="POST" action="{{ route('comments.store', ['post' => $post]) }}" class="mt-2">
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

                                <div class="mt-2">
                                    @foreach ($post->comments as $comment)
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

                        @empty
                        <p class="text-gray-500">No posts available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.likeButton').click(function(event) {
            event.preventDefault();

            $(event.target).prop("disabled", true);
            setTimeout(function() {
                $(event.target).prop("disabled", false);
            }, 3000); // in milliseconds

            var button = $(this);
            var postId = button.data('post-id');
            var likeCountElement = $('#likeCount-' + postId);
            var likeIcon = button.find('.like-icon');
            var isLiked = likeIcon.hasClass('liked');

            if (isLiked) {
                unlikePost(postId, likeCountElement, likeIcon);
            } else {
                likePost(postId, likeCountElement, likeIcon);
            }
        });

        function likePost(postId, likeCountElement, likeIcon) {
            $.ajax({
                url: '/posts/' + postId + '/like',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        var likesCount = response.likes_count;
                        likeCountElement.text(likesCount);
                        likeIcon.addClass('liked');
                        likeIcon.html('<svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1"><path d="M3,21a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H6V21ZM19.949,10H14.178V5c0-2-3.076-2-3.076-2s0,4-1.026,5C9.52,8.543,8.669,10.348,8,11V21H18.644a2.036,2.036,0,0,0,2.017-1.642l1.3-7A2.015,2.015,0,0,0,19.949,10Z" /></svg>');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function unlikePost(postId, likeCountElement, likeIcon) {
            $.ajax({
                url: '/posts/' + postId + '/unlike',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        var likesCount = response.likes_count;
                        likeCountElement.text(likesCount);
                        likeIcon.removeClass('liked');
                        likeIcon.html('<svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="none" class="h-5 w-5 text-blue-500 mr-1"><path d="M2,22H18.644a3.036,3.036,0,0,0,3-2.459l1.305-7a2.962,2.962,0,0,0-.637-2.439A3.064,3.064,0,0,0,19.949,9H15.178V5c0-2.061-2.113-3-4.076-3a1,1,0,0,0-1,1c0,1.907-.34,3.91-.724,4.284L6.593,10H2a1,1,0,0,0-1,1V21A1,1,0,0,0,2,22ZM8,11.421l2.774-2.7c.93-.907,1.212-3.112,1.3-4.584.542.129,1.109.38,1.109.868v5a1,1,0,0,0,1,1h5.771a1.067,1.067,0,0,1,.824.38.958.958,0,0,1,.21.8l-1.3,7A1.036,1.036,0,0,1,18.644,20H8ZM3,12H6v8H3Z" /></svg>');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
</script>