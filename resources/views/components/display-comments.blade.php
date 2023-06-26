 <!-- Display comments -->
 <div class="mt-2">
     @foreach ($comments as $index=>$comment)
     <div class="{{ $index>2 ? 'hidden' : '' }} comments-{{ $item->id }}">
         <div class="flex items-center">
         <x-profile-picture :profilePicture="$item->userProfilePicture" :userName="$item->userName" :userId="$item->user->id"/>
             <div class="bg-gray-100 w-full p-2 text-left rounded-lg">
                 <h3 class="text-sm font-bold">{{ $comment->user->name }}</h3>
                 <p class="text-gray-600 text-sm">{{ $comment->content }}</p>
             </div>
         </div>
         <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
     </div>
     @endforeach

     @if (count($comments) > 3)
     <x-primary-button class="mt-2" onclick="showAllComments('.comments-{{ $item->id }}')">{{ __('Show all comments') }}</x-primary-button>
     @endif
 </div>