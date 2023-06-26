<x-post-content :item="$item" />

<div class="items-center justify-center text-center mt-2 grid grid-cols-3 border-t-2">
    <x-like-button :buttonId="$item->id" :item="$item" />

    <x-comment-button :item="$item" />

    <x-share-button :item="$item" />
</div>

<div class="items-center justify-center text-center mt-2 border-t-2 px-4">
    <x-comment-form action="{{ route('comments.index', ['post' => $item]) }}" />

    <x-display-comments :comments="$item->comments" :item="$item" />
</div>