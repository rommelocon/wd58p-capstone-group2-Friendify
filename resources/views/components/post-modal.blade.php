<div class="w-full" x-data="{ open: false }">
    <!-- Modal Trigger -->
    <button x-on:click.prevent="$dispatch('open-modal','post-modal')" class="text-left w-full h-auto p-2 border border-gray-300 rounded-lg font-sans text-sm leading-5 resize-vertical bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id=" modal-toggle">
        Write your post...
    </button>

    <!-- Modal -->
    <x-modal name="post-modal" class="vertical-center">
        <div class="w-full bg-transparent my-auto">
            <div class="w-full inset-0 overflow-y-auto">

                <div class=" rounded-lg shadow-lg p-6 bg-transparent">
                    <div class="flex justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">New Post</h2>
                        <button x-on:click="$dispatch('close')" class="text-gray-600">
                            <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.93 2.93a1 1 0 01-1.415-1.415l2.929-2.93L4.646 6.464a1 1 0 011.415-1.415L10 8.586l2.93-2.93a1 1 0 011.414 1.415l-2.93 2.929 2.93 2.93a1 1 0 010 1.414z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div>
                        <form method="POST" action="{{ route('posts.store') }}" class="mb-4" enctype="multipart/form-data">
                            @csrf
                            <div class="w-full flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg">
                                <textarea name="content" class="description bg-gray-100 sec p-3 h-40 border border-gray-300 outline-none resize-none" spellcheck="false" placeholder="Describe everything about this post here"></textarea>

                                <div class="mt-3">
                                    <!-- Image Upload -->
                                    <label for="image" class="cursor-pointer">
                                        <i class="fa-solid fa-file-image"></i>
                                        <span class="ml-2 text-gray-700">Upload Image</span>
                                        <input id="image" type="file" name="image" class="hidden">
                                    </label>

                                    <!-- Video Upload -->
                                    <label for="video" class="cursor-pointer">
                                        <i class="fa-solid fa-file-video"></i>
                                        <span class="ml-2 text-gray-700">Upload Video</span>
                                        <input id="video" type="file" name="video" class="hidden">
                                    </label>
                                </div>

                                <!-- Buttons -->
                                <div class="mt-4 text-center">
                                    <x-primary-button class="w-full" display="block">{{ __('Post') }}</x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-modal>
</div>