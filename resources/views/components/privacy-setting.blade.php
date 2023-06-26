@props(['item', 'user', 'action'])
<!-- Privacy Setting Dropdown -->
@if (Auth::user()->id == $item->user->id)
<form id="privacyForm_{{ $item->id }}" action="{{ $action }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <select class="form-select w-full" name="privacy" id="privacy" onchange="submitPrivacyForm({{ $item->id }})">
            <option value="public" @if ($item->privacy === 'public') selected @endif>Public</option>
            <option value="friends" @if ($item->privacy === 'friends') selected @endif>Friends</option>
            <option value="private" @if ($item->privacy === 'private') selected @endif>Private</option>
        </select>
    </div>
</form>
@endif

<script>
    function submitPrivacyForm(postId) {
        const form = document.getElementById('privacyForm_' + postId);
        const selectedOption = form.elements.privacy.value;
        const url = form.action;

        // Send an AJAX request to update the privacy
        axios.put(url, {
                privacy: selectedOption
            })
            .then(function(response) {
                console.log(response.data.message);
            })
            .catch(function(error) {
                console.log(error);
            });
    }
</script>