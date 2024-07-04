 @if (session('success'))
    <div class="mb-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        <p class="font-bold">{{ session('success') }}</p>
    </div>
@endif