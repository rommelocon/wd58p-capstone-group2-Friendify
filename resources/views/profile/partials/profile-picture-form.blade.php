<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile picture.") }}
        </p>
    </header>


    <form class="mt-6 space-y-6" action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <div class="flex items-center">
                <div class="w-16 h-16 mr-4">
                    @if (Auth::user()->profilePicture)
                    <img src="{{ asset('storage/' . Auth::user()->profilePicture->image_path) }}" alt="Profile Picture" class="w-full h-full object-cover rounded-full">
                    @else
                    <img src="{{ asset('storage/default-profile-photo.png') }}" alt="Default Profile Picture" class="w-full h-full object-cover rounded-full">
                    @endif
                </div>
                <div>
                    <input type="file" id="profile_picture" name="profile_picture" class="mt-1">
                    @error('profile_picture')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex">
            <x-primary-button type="submit" class="btn btn-primary mr-2">Update Picture</x-primary-button>
            @if (Auth::user()->profilePicture)
            <form action="{{ route('profile.picture.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <x-danger-button type="submit" class="btn btn-danger">Delete Picture</x-danger-button>
            </form>
            @endif
        </div>
    </form>


</section>