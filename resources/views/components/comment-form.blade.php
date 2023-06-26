<!-- Comment form -->
<form method="POST" action="{{ $action }}" class="mt-2">
    @csrf
    <div class="flex items-center">
        <input type="text" name="content" placeholder="Write a comment..." class="form-input flex-grow px-2 sm:px-4 py-2 border rounded-lg border-gray-200 rounded-e-none">
        <button type="submit" class="px-2 sm:px-4 py-[8px] border border-l-0 border-gray-200 text-white rounded-lg rounded-s-none">
            <i class="fa-regular fa-comment text-black"></i>
        </button>
    </div>
</form>