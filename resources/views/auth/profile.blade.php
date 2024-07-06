<x-tailadmin-layout>
    @php
        $values = [
            "Alabama" => "Alabama",
            "Alaska" => "Alaska",
            "Arkansas" => "Arkansas",
            "California" => "California",
            "Colorado" => "Colorado",
            "Connecticut" => "Connecticut",
            "Delaware" => "Delaware",
            "District of Columbia" => "District of Columbia",
            "Florida" => "Florida",
            "Georgia" => "Georgia",
            "Hawaii" => "Hawaii",
            "Idaho" => "Idaho",
            "Illinois" => "Illinois",
            "Indiana" => "Indiana",
            "Iowa" => "Iowa",
            "Kansas" => "Kansas",
            "Kentucky" => "Kentucky",
            "Louisiana" => "Louisiana",
            "Maine" => "Maine",
            "Maryland" => "Maryland",
            "Massachusetts" => "Massachusetts",
            "Michigan" => "Michigan",
            "Minnesota" => "Minnesota",
            "Mississippi" => "Mississippi",
            "Missouri" => "Missouri",
            "Montana" => "Montana",
            "Nebraska" => "Nebraska",
            "Nevada" => "Nevada",
            "New Hampshire" => "New Hampshire",
            "New Jersey" => "New Jersey",
            "New Mexico" => "New Mexico",
            "New York" => "New York",
            "North Carolina" => "North Carolina",
            "North Dakota" => "North Dakota",
            "Ohio" => "Ohio",
            "Oklahoma" => "Oklahoma",
            "Oregon" => "Oregon",
            "Pennsylvania" => "Pennsylvania",
            "Rhode Island" => "Rhode Island",
            "South Carolina" => "South Carolina",
            "South Dakota" => "South Dakota",
            "Tennessee" => "Tennessee",
            "Texas" => "Texas",
            "Utah" => "Utah",
            "Vermont" => "Vermont",
            "Virginia" => "Virginia",
            "Washington" => "Washington",
            "West Virginia" => "West Virginia",
            "Wisconsin" => "Wisconsin",
            "Wyoming" => "Wyoming"
        ];
    @endphp

    <x-flash-success />

    <x-flash-error />

    <!-- ====== Form Layout Section Start -->
    <div class="grid grid-cols-1 gap-9 sm:grid-cols-2">
        <div class="flex flex-col gap-9">
        <!-- Contact Form -->
        <div
            class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
        >
            <div
            class="border-b border-stroke px-6.5 py-4 dark:border-strokedark"
            >
            <h3 class="font-medium text-black dark:text-white">
                Profile
            </h3>
            </div>
            <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <div class="p-6.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                <div class="w-full xl:w-1/2">
                    <x-input-label-t for="first_name">
                        First name<span class="text-meta-1">*</span>
                    </x-input-label-t>
                    <x-text-input-t
                        id="first_name"
                        type="text"
                        name="first_name"
                        :value="$user->first_name"
                        placeholder="Enter your first name"
                        required
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div class="w-full xl:w-1/2">
                    <x-input-label-t for="last_name">
                        Last name<span class="text-meta-1">*</span>
                    </x-input-label-t>
                    <x-text-input-t
                        id="last_name"
                        type="text"
                        name="last_name"
                        placeholder="Enter your last name"
                        :value="$user->last_name"
                        required
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
                </div>

                <div class="mb-4.5">
                    <x-input-label-t for="email">
                        Email <span class="text-meta-1">*</span>
                    </x-input-label-t>
                    <x-text-input-t
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Enter your email address"
                        :value="$user->email"
                        required
                        readonly
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4.5">
                    <x-input-label-t for="membershipid">
                        Membership Id <span class="text-meta-1">*</span>
                    </x-input-label-t>
                    <x-text-input-t
                        id="membershipid"
                        type="text"
                        name="membershipid"
                        placeholder="Enter your membership id"
                        :value="$user->membershipid"
                        readonly
                        required
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('membershipid')" class="mt-2" />
                </div>

                <div class="mb-4.5">
                    <x-input-label-t for="phone">
                        Phone
                    </x-input-label-t>
                    <x-text-input-t
                        id="phone"
                        type="text"
                        name="phone"
                        placeholder="Enter your phone number"
                        :value="$user->phone"
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="mb-4.5">
                <x-input-label-t for="state">
                        State <span class="text-meta-1">*</span>
                    </x-input-label-t>
                <x-select-t id="state" 
                        name="state" 
                        :values="$values"
                        :selected="$user->state">
                </x-select-t>
                </div>

                <div class="mb-4.5">
                    <x-input-label-t for="town">
                        Town <span class="text-meta-1">*</span>
                    </x-input-label-t>
                    <x-text-input-t
                        id="town"
                        type="text"
                        name="town"
                        :value="$user->town"
                        placeholder="Enter your town"
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <button
                class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90"
                >
                Update Profile
                </button>
            </div>
            </form>
        </div>
        </div>

        <!-- Sign Up Form -->
        <div
            class="flex flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
        >
            <div
            class="border-b border-stroke px-6.5 py-4 dark:border-strokedark"
            >
            <h3 class="font-medium text-black dark:text-white">
                Change Password
            </h3>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            
            <div class="p-6.5">
                <!-- Password -->
                <div class="mb-4.5">
                    <x-input-label-t for="current_password" :value="__('Current Password')" />

                    <x-text-input-t id="current_password" 
                                    type="password"
                                    placeholder="Enter current password"
                                    name="current_password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4.5">
                    <x-input-label-t for="password" :value="__('Password')" />

                    <x-text-input-t id="password" 
                                    type="password"
                                    placeholder="Enter password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4.5">
                    <x-input-label-t for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input-t id="password_confirmation" 
                                    type="password"
                                    placeholder="Re-enter password"
                                    autocomplete="re-enter-password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                <button
                class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90"
                >
                Change Password
                </button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- ====== Form Layout Section End -->
</x-tailadmin-layout>