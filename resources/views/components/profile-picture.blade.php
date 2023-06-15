@props(['profilePicture', 'userName', 'width' => 12])

<div class="w-{{$width}} h-{{$width}} rounded-full mr-2 object-cover overflow-hidden">
    @if ($profilePicture)
    <img src="{{ asset('storage/' . $profilePicture->image_path) }}" alt="{{ $userName }}" class="">
    @else
    <img src="{{ asset('storage/default-profile-photo.png') }}" alt="{{ $userName }}" class="profile-picture">
    @endif
</div>