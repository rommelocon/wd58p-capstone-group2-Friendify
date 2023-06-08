@props(['profilePicture'])

<div class="profile-picture">
    @if ($profilePicture)
    <img class="w-10 h-10 rounded-full mr-2" src="{{ asset('storage/' . $profilePicture->image_path) }}" alt="Profile Picture">
    @else
    <img class="w-10 h-10 rounded-full mr-2" src="{{ asset('storage/default-profile-photo.png') }}" alt="Default Profile Picture">
    @endif
</div>