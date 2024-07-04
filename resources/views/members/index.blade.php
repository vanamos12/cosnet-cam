<x-tailadmin-layout>
    
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <x-page-heading>Members</x-page-heading>
            <a href="{{ route('member.create') }}"
                class="flex py-3 px-6 font-bold  items-center justify-center rounded-md bg-primary text-white hover:bg-opacity-90"
            >
            Create
            </a>
        </div>

        @unless(empty($members))
            <p>You don't have members.</p>
        @endunless
        
    
</x-tailadmin-layout>