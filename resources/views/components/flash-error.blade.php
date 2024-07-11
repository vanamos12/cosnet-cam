@if (session('error'))
    <div class="mb-5 bg-danger bg-opacity-10 border border-danger text-danger px-4 py-3 rounded relative">
        <p class="font-bold">{{ session('error') }}</p>
    </div>
@endif