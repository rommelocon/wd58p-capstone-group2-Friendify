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
            <div class="flex items-center justify-center w-full">
                <x-profile-picture :userId="$user->id" :profilePicture="$user->profilePicture" :userName="$user->name" class="big-picture"/>
                @if(!auth()->user()->profilePicture)
                <div>
                    <input type="file" id="profile_picture" name="profile_picture" class="mt-1">
                    @error('profile_picture')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                @endif
            </div>
        </div>

        <div class="flex">
            @if(!auth()->user()->profilePicture)
            <x-primary-button type="submit" class="btn btn-primary mr-2">Update Picture</x-primary-button>
            @elseif (Auth::user()->profilePicture)
            <form action="{{ route('profile.picture.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <x-danger-button type="submit" class="btn btn-danger">Delete Picture</x-danger-button>
            </form>
            @endif
        </div>
    </form>


</section>