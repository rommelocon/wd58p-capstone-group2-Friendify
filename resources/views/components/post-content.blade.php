<!-- Original Post Content -->
<div class="original-post px-2">
    <div class="flex justify-between">
        <div class="flex items-center mb-2">
            <!-- User post profile picture -->
            <x-profile-picture :profilePicture="$item->userProfilePicture" :userName="$item->userName" />
            <div class="flex flex-col">
                <h3 class="text-lg font-semibold">{{ $item->userName }}</h3>
                <p class="text-sm text-gray-600">{{ $item->createdAtFormatted }}</p>
            </div>
        </div>

        @if ($item instanceof App\Models\Post)
        <x-privacy-setting :item="$item" :user="$item->user" action="/posts/{{ $item->id }}/privacy" />
        @endif
    </div>
    <p class="text-gray-800 font-medium text-md leading-7">{{ $item->textContent }}</p>
    <!-- Display image if available -->
    @if ($item->postImage)
    <div class="w-full bg-gray-100 overflow-hidden">
        <div class="h-[800px] mx-auto">
            <img src="{{ asset('storage/' . $item->postImage) }}" alt="Post Image" class="w-full h-full object-cover object-top">
        </div>
    </div>
    @endif
    <!-- Display video if available -->
    @if ($item->postVideo)
    <div class="w-full bg-gray-900 overflow-hidden">
        <div class="h-[800px] mx-auto">
            <video controls class="w-full mt-4 h-full">
                <source src="{{ asset('storage/' . $item->postVideo) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    @endif
</div>