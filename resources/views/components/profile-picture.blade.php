@props(['profilePicture', 'userName'])

<div {{ $attributes->merge(['class'=>'small-picture']) }}>
    @if ($profilePicture)
    <img src="{{ asset('storage/' . $profilePicture->image_path) }}" alt="{{ $userName }}" class="">
    @else
    <img src="{{ asset('storage/default-profile-photo.png') }}" alt="{{ $userName }}" class="profile-picture">
    @endif
</div>