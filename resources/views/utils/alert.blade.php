{{-- Message --}}
@if (Session::has('message'))
    <div id="popup-message" class="fixed top-20 left-1/3 transform-translate-x-1/2 bg-gray-500 text-white px-48 py-3">
        {{ session('message') }}
    </div>
@endif

@if (Session::has('error'))
<div id="popup-message" class="fixed top-20 left-1/3 transform-translate-x-1/2 bg-red-500 text-white px-48 py-3">
    {{ session('error') }}
</div>
@endif
<script>
    setTimeout(function() {
        var popup = document.getElementById('popup-message');
        if (popup) {
            popup.classList.add('hidden');
        }
    }, 3000);
</script>
