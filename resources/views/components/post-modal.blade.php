<x-modal name="my-modal" :show="true" maxWidth="2xl">
    <!-- component -->
    <div class="heading text-center font-bold text-2xl m-5 text-gray-800">New Post</div>
    <style>
        body {
            background: white !important;
        }
    </style>
    <form method="POST" action="{{ route('posts.store') }}" class="mb-4" enctype="multipart/form-data">
        @csrf
        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
            <textarea name="content" class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false" placeholder="Describe everything about this post here"></textarea>

            <!-- icons -->
            <div class="icons flex text-gray-500 m-2">

                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <!-- SVG code -->
                </svg>
                <!-- Other icons -->
            </div>

            <input type="file" name="image">
            <input type="file" name="video">

            <!-- buttons -->
            <div class="buttons flex">
                <x-danger-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-danger-button>
                <x-primary-button>{{ __('Post') }}</x-primary-button>
            </div>
        </div>
    </form>
</x-modal>