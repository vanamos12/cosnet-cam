<x-tailadmin-layout>
        <x-flash-success />

        <x-flash-error />

        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <x-page-heading>Members</x-page-heading>
            <a href="{{ route('member.create') }}"
                class="flex py-3 px-6 font-bold  items-center justify-center rounded-md bg-primary text-white hover:bg-opacity-90"
            >
            Add Member
            </a>
        </div>

        @unless(!count($members))
            <div class="max-w-full overflow-x-auto">
                <div class="min-w-[1170px]">
                    <!-- table header start -->
                    <div
                    class="grid grid-cols-12 rounded-t-[10px] bg-primary px-5 py-4 lg:px-7.5 2xl:px-11"
                    >
                    <div class="col-span-3">
                        <h5 class="font-medium text-white">First Name</h5>
                    </div>

                    <div class="col-span-3">
                        <h5 class="font-medium text-white">Last Name</h5>
                    </div>

                    <div class="col-span-3">
                        <h5 class="font-medium text-white">Email</h5>
                    </div>

                    <div class="col-span-2">
                        <h5 class="font-medium text-white">MembershipId</h5>
                    </div>

                    <div class="col-span-1">
                        <h5 class="text-right font-medium text-white">Edit</h5>
                    </div>
                    </div>
                    <!-- table header end -->

                    <!-- table body start -->
                    <div class="bg-white dark:bg-boxdark">
                    <!-- table row item -->
                    @foreach ($members as $member)
                        
                    
                    <div
                        class="grid grid-cols-12 border-t border-[#EEEEEE] px-5 py-4 dark:border-strokedark lg:px-7.5 2xl:px-11"
                    >
                        <div class="col-span-3">
                        <p class="text-[#637381] dark:text-bodydark">{{ $member->first_name }}</p>
                        </div>

                        <div class="col-span-3">
                        <p class="text-[#637381] dark:text-bodydark">
                            {{ $member->last_name }}
                        </p>
                        </div>

                        <div class="col-span-3">
                        <p class="text-[#637381] dark:text-bodydark">{{ $member->email }}</p>
                        </div>

                        <div class="col-span-2">
                        <p class="text-[#637381] dark:text-bodydark">{{ $member->membershipid }}</p>
                        </div>

                        <div class="col-span-1">
                        <div x-data="{ isOpen: false }" class="relative h-full">
                            <button
                            @click.prevent="isOpen = !isOpen"
                            class="float-right inline-flex items-center gap-1.5 rounded-md px-3 py-1.5 text-sm text-black shadow-11 hover:text-primary dark:bg-meta-4 dark:text-white dark:shadow-none"
                            >
                            Action
                            <svg
                                class="fill-current"
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                d="M8.00039 11.4C7.85039 11.4 7.72539 11.35 7.60039 11.25L1.85039 5.60005C1.62539 5.37505 1.62539 5.02505 1.85039 4.80005C2.07539 4.57505 2.42539 4.57505 2.65039 4.80005L8.00039 10.025L13.3504 4.75005C13.5754 4.52505 13.9254 4.52505 14.1504 4.75005C14.3754 4.97505 14.3754 5.32505 14.1504 5.55005L8.40039 11.2C8.27539 11.325 8.15039 11.4 8.00039 11.4Z"
                                fill=""
                                />
                            </svg>
                            </button>

                            <div
                            @click.outside="isOpen = false"
                            x-show="isOpen"
                            class="absolute right-0 top-full z-1 mt-1 w-full max-w-39.5 rounded-[5px] bg-white py-2.5 shadow-12 dark:bg-boxdark"
                            >
                            <button
                                class="flex w-full px-4 py-2 text-sm hover:bg-whiter hover:text-primary dark:hover:bg-meta-4"
                            >
                                Edit
                            </button>
                            <button
                                class="flex w-full px-4 py-2 text-sm hover:bg-whiter hover:text-primary dark:hover:bg-meta-4"
                            >
                                Delete
                            </button>
                            <button
                                class="flex w-full px-4 py-2 text-sm hover:bg-whiter hover:text-primary dark:hover:bg-meta-4"
                            >
                                Details
                            </button>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                    <!-- table body end -->
                </div>
            </div>
           <div class="mt-4">
                {{ $members->links() }}
           </div> 
        @endunless

        @unless(count($members))
            <p>You don't have members.</p>
        @endunless
        
    
</x-tailadmin-layout>