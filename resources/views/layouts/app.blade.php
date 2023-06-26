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
    <div class="min-h-screen flex-1 flex flex-col bg-gradient-to-br from-white to-[#d1d1d1]">
        @include('layouts.navigation')

        <!-- Page Heading
        @if (isset($header))
        <header class="bg-[#C9DBB2]">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif -->

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

                if (button.disabled) {
                    return; // Do nothing if the button is already disabled
                }

                button.disabled = true; // Disable the button

                if (isLiked) {
                    unlikePost(postId, likeCountElement, likeIcon)
                        .then(response => {
                            if (response.data.success) {
                                const likesCount = response.data.likes_count;
                                likeCountElement.textContent = likesCount;
                                likeIcon.classList.remove('liked');
                                likeIcon.innerHTML = '<i class="fa-regular fa-heart h-5 w-5 text-black mr-1"></i>';
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        })
                        .finally(() => {
                            button.disabled = false; // Enable the button after the request is complete
                        });
                } else {
                    likePost(postId, likeCountElement, likeIcon)
                        .then(response => {
                            if (response.data.success) {
                                const likesCount = response.data.likes_count;
                                likeCountElement.textContent = likesCount;
                                likeIcon.classList.add('liked');
                                likeIcon.innerHTML = '<i class="fa-solid fa-heart h-5 w-5 text-red-500 mr-1"></i>';
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        })
                        .finally(() => {
                            button.disabled = false; // Enable the button after the request is complete
                        });
                }
            });
        });

        function likePost(postId, likeCountElement, likeIcon) {
            return axios.post('/posts/' + postId + '/like', {
                _token: '{{ csrf_token() }}'
            });
        }

        function unlikePost(postId, likeCountElement, likeIcon) {
            return axios.post('/posts/' + postId + '/unlike', {
                _token: '{{ csrf_token() }}'
            });
        }

    });

    // JavaScript to handle cancel buttons and file preview
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file');
        const filePreviewContainer = document.getElementById('file-preview');
        const filePreviewImage = document.getElementById('file-preview-img');
        const filePreviewPlayer = document.getElementById('file-preview-player');
        const cancelFileButton = document.getElementById('cancel-file');
        const uploadButton = document.querySelector('.upload-button');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            const fileType = file.type;

            // Hide the current preview (if any)
            hideFilePreview();

            // Display the cancel button
            cancelFileButton.classList.remove('hidden');

            // Check if the file type is an image
            if (fileType.startsWith('image/')) {
                filePreviewImage.src = URL.createObjectURL(file);
                filePreviewImage.classList.remove('hidden');
            }
            // Check if the file type is a video
            else if (fileType.startsWith('video/')) {
                filePreviewPlayer.src = URL.createObjectURL(file);
                filePreviewPlayer.classList.remove('hidden');
            }

            // Show the file preview container
            filePreviewContainer.classList.remove('hidden');

            // Disable the upload button
            uploadButton.disabled = true;
        });

        cancelFileButton.addEventListener('click', function() {
            // Clear the file input value
            fileInput.value = '';

            // Hide the file preview
            hideFilePreview();

            // Hide the cancel button
            cancelFileButton.classList.add('hidden');

            // Enable the upload button if no file is selected
            uploadButton.disabled = fileInput.files.length === 0;
        });

        function hideFilePreview() {
            // Hide the file preview container
            filePreviewContainer.classList.add('hidden');

            // Hide the image preview
            filePreviewImage.src = '#';
            filePreviewImage.classList.add('hidden');

            // Hide the video preview
            filePreviewPlayer.src = '#';
            filePreviewPlayer.classList.add('hidden');
        }

        // Disable the upload button if a file is already selected on page load
        uploadButton.disabled = fileInput.files.length > 0;
    });
</script>

</html>