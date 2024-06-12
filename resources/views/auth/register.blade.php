<x-guest-layout>
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
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div class="mt-4">
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="$first_name" required autofocus  />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="$last_name" required autofocus />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Membership Id -->
        <div class="mt-4">
            <x-input-label for="membershipid" :value="__('Membership Id')" />
            <x-text-input id="membershipid" class="block mt-1 w-full" type="text" name="membershipid" :value="$membershipid" required autofocus disabled/>
            <x-input-error :messages="$errors->get('membershipid')" class="mt-2" />
        </div>

        <!-- State -->
        <div class="mt-4">
            <x-input-label for="state" :value="__('State')" />
            <x-select id="state" class="block mt-1 w-full" name="state"  :values="$values" selected="Alabama" required autofocus />
            <x-input-error :messages="$errors->get('state')" class="mt-2" />
        </div class="mt-4">

        <!-- Town -->
        <div class="mt-4">
            <x-input-label for="town" :value="__('Town')" />
            <x-text-input id="town" class="block mt-1 w-full" type="text" name="town" :value="old('town')" required autofocus />
            <x-input-error :messages="$errors->get('town')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$email" required disabled/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
