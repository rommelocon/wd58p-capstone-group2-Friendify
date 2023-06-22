<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/fd5c9838ec.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#E3F2C1]">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-[#C9DBB2]">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('.share-form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var form = $(this);
            var url = form.attr('action');
            var postId = form.find('input[name="original_post_id"]').val();

            // Retrieve the CSRF token value from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send AJAX request to create a new post referencing the original post
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                data: {
                    original_post_id: postId
                },
                success: function(response) {
                    // Handle success response
                    alert('Post shared successfully!');
                },
                error: function(xhr) {
                    // Handle error response
                    alert('Error sharing post.');
                }
            });
        });
    });

    const showAllComments = (className) => {
        Array.from(document.querySelectorAll(className)).forEach((el) =>
            el.classList.remove("hidden")
        );

        console.log('test');
    };

    document.addEventListener('DOMContentLoaded', function() {
        const reactionButtons = document.querySelectorAll('.reaction-btn');

        reactionButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const button = this;
                const postId = button.dataset.postId;
                const likeCountElement = document.querySelector('#likeCount-' + postId);
                const likeIcon = button.querySelector('.like-icon');
                const isLiked = likeIcon.classList.contains('liked');

                button.disabled = true;
                setTimeout(function() {
                    button.disabled = false;
                }, 3000); // in milliseconds

                if (isLiked) {
                    unlikePost(postId, likeCountElement, likeIcon);
                } else {
                    likePost(postId, likeCountElement, likeIcon);
                }
            });
        });

        function likePost(postId, likeCountElement, likeIcon) {
            axios.post('/posts/' + postId + '/like', {
                    _token: '{{ csrf_token() }}'
                })
                .then(function(response) {
                    if (response.data.success) {
                        const likesCount = response.data.likes_count;
                        likeCountElement.textContent = likesCount;
                        likeIcon.classList.add('liked');
                        likeIcon.innerHTML = '<i class="fa-solid fa-heart h-5 w-5 text-red-500 mr-1"></i>';
                    }
                })
                .catch(function(error) {
                    console.error(error);
                });
        }

        function unlikePost(postId, likeCountElement, likeIcon) {
            axios.post('/posts/' + postId + '/unlike', {
                    _token: '{{ csrf_token() }}'
                })
                .then(function(response) {
                    if (response.data.success) {
                        const likesCount = response.data.likes_count;
                        likeCountElement.textContent = likesCount;
                        likeIcon.classList.remove('liked');
                        likeIcon.innerHTML = '<i class="fa-regular fa-heart h-5 w-5 text-black mr-1"></i>';
                    }
                })
                .catch(function(error) {
                    console.error(error);
                });
        }
    });
</script>

</html>