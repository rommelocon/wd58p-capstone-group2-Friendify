<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <x-post :feed="$feed" :posts="$posts" :user="$user" />

            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reactionButton = document.getElementById('reaction-btn');

        reactionButton.addEventListener('click', function(event) {
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