<!-- Original Post Content -->
<div class="original-post px-2">
    <div class="flex justify-between">
        <div class="flex items-center mb-2">
            <!-- User post profile picture -->

            <x-profile-picture :profilePicture="$item->userProfilePicture" :userName="$item->userName" :userId="$item->user->id" />
            <div class="flex flex-col">
                <x-route-profile :userId="$item->user->id" :userName="$item->userName" />
                <p class="text-sm text-gray-600">{{ $item->createdAtFormatted }}</p>
            </div>
        </div>

        @if ($item instanceof App\Models\Post)
        <x-privacy-setting :item="$item" :user="$item->user" action="/posts/{{ $item->id }}/privacy" />
        @endif
    </div>
    <p class="text-gray-800 font-medium text-md leading-7">{{ $item->textContent }}</p>

    <x-post-content-modal :item="$item" />
</div>

