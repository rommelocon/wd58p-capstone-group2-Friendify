@props(['height' => 'auto', 'item', 'modal' => 'postModal', 'title' => 'New Post'])

<div class="w-full" x-data="{ open: false }">
    <!-- Modal Trigger -->
    <button x-on:click.prevent="$dispatch('open-modal','original-post-{{ $item->id }}-{{ $modal }}')" class="w-full" id=" modal-toggle">
        <!-- Display image if available -->
        @if ($item->postImage)
        <div class="w-full bg-gray-100 overflow-hidden">
            <div class="h-[{{ $height }}] mx-auto">
                <img src="{{ asset('storage/' . $item->postImage) }}" alt="Post Image" class="w-full h-full object-cover object-top">
            </div>
        </div>
        @endif
        <!-- Display video if available -->
        @if ($item->postVideo)
        <div class="w-full bg-gray-900 overflow-hidden">
            <div class="h-[{{ $height }}] mx-auto">
                <video controls class="w-full mt-4 h-full">
                    <source src="{{ asset('storage/' . $item->postVideo) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        @endif
    </button>

    <!-- Modal -->
    <x-modal name="original-post-{{ $item->id }}-{{ $modal }}" class="vertical-center" :maxWidth="'8xl'">
        <div class="w-full bg-transparent my-auto">
            <div class="w-full inset-0 overflow-y-auto">
                <div class="w-full rounded-lg shadow-lg p-6 bg-transparent">
                    <div class="flex justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">{{ $title }}</h2>
                        <button x-on:click="$dispatch('close')" class="text-gray-600">
                            <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.93 2.93a1 1 0 01-1.415-1.415l2.929-2.93L4.646 6.464a1 1 0 011.415-1.415L10 8.586l2.93-2.93a1 1 0 011.414 1.415l-2.93 2.929 2.93 2.93a1 1 0 010 1.414z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Content -->
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
                    <!-- Original Post Content -->

                    <div class="original-post px-2">

                        <p class="text-gray-800 font-medium text-md leading-7">{{ $item->textContent }}</p>
                        <!-- Display image if available -->
                        @if ($item->postImage)
                        <div class="w-full bg-gray-100 overflow-hidden">
                            <div class="h-[750px] mx-auto">
                                <img src="{{ asset('storage/' . $item->postImage) }}" alt="Post Image" class="w-full h-full object-cover object-top">
                            </div>
                        </div>
                        @endif
                        <!-- Display video if available -->
                        @if ($item->postVideo)
                        <div class="w-full bg-gray-900 overflow-hidden">
                            <div class="h-[750px] mx-auto">
                                <video controls class="w-full mt-4 h-full">
                                    <source src="{{ asset('storage/' . $item->postVideo) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </x-modal>
</div>