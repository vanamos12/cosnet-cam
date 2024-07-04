@if (session('error'))
    <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
        <p class="font-bold">{{ session('error') }}</p>
    </div>
@endif