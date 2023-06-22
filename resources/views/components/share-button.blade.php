 <!-- Share button -->
 <form action="{{ route('posts.share') }}" method="POST" class="share-form">
     @csrf
     <input type="hidden" name="original_post_id" value="{{ $item->id }}">
     <button type="submit" class="flex items-center justify-center text-center p-2 w-full hover:bg-gray-100">
         <i class="fa-solid fa-share h-5 w-5 text-black mr-1"></i>
         <span class="text-gray-800">{{ $item->shares_count }}</span>
     </button>
 </form>