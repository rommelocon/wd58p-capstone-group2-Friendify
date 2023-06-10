@props(['profilePicture', 'width' => 16, 'mr' => 2])

<div {{ $attributes->merge(['class' => "w-$width h-$width rounded-full mr-$mr object-cover overflow-hidden"]) }}>
    <img src="{{ $profilePicture ? asset('storage/' . $profilePicture->image_path) : asset('storage/default-profile-photo.png') }}" alt="{{ $profilePicture ? 'Profile Picture' : 'Default Profile Picture' }}" {{ $attributes->merge(['class' => "w-full h-full"]) }}>
</div>