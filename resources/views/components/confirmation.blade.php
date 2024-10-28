


@if(session('success'))
<div class="bg-green-400 text-bold px-3 py-2 rounded mb-4" id="success-message">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-400 text-bold px-3 py-2 rounded mb-4" id="error-message">
    {{ session('error') }}
</div>
@endif

<script>
    setTimeout(() => {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }

        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 3000);
</script>
