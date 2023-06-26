 <!-- Shared Post Content -->
 <div class="original-post px-4">
     <div class="flex justify-between">
         <div class="flex items-center mb-2">
             <!-- User post profile picture -->
             <x-profile-picture :profilePicture="$item->user->profilePicture" :userName="$item->user->name" :userId="$item->user->id" />
             <div class="flex flex-col">
                 <h3 class="text-lg font-semibold">{{ $item->user->name }}</h3>
                 <p class="text-sm text-gray-600">{{ $item->created_at->diffForHumans() }}</p>
             </div>
         </div>

         <x-privacy-setting :item="$item" :user="$item->user" action="/share/{{ $item->id }}/privacy" />
     </div>
 </div>

 <div class="post p-4 mb-4 border border-r-0 border-l-0">
     <x-post-content :item="$item" />
 </div>

 <div class="items-center justify-center text-center mt-2 grid grid-cols-3 border-t-2">
     <x-like-button buttonId="share-reaction-btn-{{ $item->id }}" :item="$item" />

     <x-comment-button :item="$item" />

     <x-share-button :item="$item" />
 </div>

 <div class="items-center justify-center text-center mt-2 border-t-2 px-4">
     <x-comment-form action="{{ route('share-comments.index', ['share' => $item]) }}" />

     <x-display-comments :comments="$item->comments" :item="$item" />
 </div>


 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const reactionButtons = document.querySelectorAll('.reaction-btn');
         const shareReactionButtons = document.querySelectorAll('.share-reaction-btn');

         reactionButtons.forEach(button => {
             button.addEventListener('click', function(event) {
                 // ...
                 // Existing code for regular post like functionality
                 // ...
             });
         });

         shareReactionButtons.forEach(button => {
             button.addEventListener('click', function(event) {
                 event.preventDefault();

                 const button = this;
                 const shareId = button.dataset.shareId;
                 const shareLikeCountElement = button.querySelector('.share-like-count');
                 const shareLikeIcon = button.querySelector('.share-like-icon');
                 const isShareLiked = shareLikeIcon.classList.contains('liked');

                 button.disabled = true;
                 setTimeout(function() {
                     button.disabled = false;
                 }, 3000); // in milliseconds

                 if (isShareLiked) {
                     unlikeShare(shareId, shareLikeCountElement, shareLikeIcon);
                 } else {
                     likeShare(shareId, shareLikeCountElement, shareLikeIcon);
                 }
             });
         });

         // ...

         function likeShare(shareId, shareLikeCountElement, shareLikeIcon) {
             axios.post('/shares/' + shareId + '/like', {
                     _token: '{{ csrf_token() }}'
                 })
                 .then(function(response) {
                     if (response.data.success) {
                         const shareLikesCount = response.data.likes_count;
                         shareLikeCountElement.textContent = shareLikesCount;
                         shareLikeIcon.classList.add('liked');
                         shareLikeIcon.innerHTML = '<i class="fa-solid fa-heart h-5 w-5 text-red-500 mr-1"></i>';
                     }
                 })
                 .catch(function(error) {
                     console.error(error);
                 });
         }

         function unlikeShare(shareId, shareLikeCountElement, shareLikeIcon) {
             axios.post('/shares/' + shareId + '/unlike', {
                     _token: '{{ csrf_token() }}'
                 })
                 .then(function(response) {
                     if (response.data.success) {
                         const shareLikesCount = response.data.likes_count;
                         shareLikeCountElement.textContent = shareLikesCount;
                         shareLikeIcon.classList.remove('liked');
                         shareLikeIcon.innerHTML = '<i class="fa-regular fa-heart h-5 w-5 text-black mr-1"></i>';
                     }
                 })
                 .catch(function(error) {
                     console.error(error);
                 });
         }
     });
 </script>