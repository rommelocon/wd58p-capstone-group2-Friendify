@props(['profilePicture', 'userName', 'userId'])

<a href="{{ route('profile.index', $userId) }}" class="text-lg font-semibold">
    <div {{ $attributes->merge(['class'=>'small-picture']) }}>
        @if ($profilePicture)
        <img src="{{ asset('storage/' . $profilePicture->image_path) }}" alt="{{ $userName }}" class="profile-picture w-full h-full">
        @else
        <img src="{{ asset('storage/default-profile-photo.png') }}" alt="{{ $userName }}" class="profile-picture w-full h-full">
        @endif
    </div>
</a>