<!-- Like button -->
<form method="POST">
    @csrf
    <button id="{{ $buttonId ?? '' }}" class="flex items-center justify-center text-center p-2 likeButton w-full hover:bg-gray-100 reaction-btn" data-post-id="{{ $item->id }}">
        <span class="like-icon">
            @if ($item->isLikedBy(auth()->user()))
            <i class="fa-solid fa-heart h-5 w-5 text-red-500 mr-1"></i>
            @else
            <i class="fa-regular fa-heart h-5 w-5 text-black mr-1"></i>
            @endif
        </span>
        <span id="likeCount-{{ $item->id }}" class="text-gray-800">{{ $item->likes_count }}</span>
    </button>
</form>