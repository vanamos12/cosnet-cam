<x-guest-layout>
    <form method="POST" action="{{ route('sign-up-step2') }}"
        x-data="{ 'toggleMembershipId': {{ old('cosnetmember') === 'cosnetmember' ? 'true' : 'false'}} }">
        @csrf

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="code" :value="__('Code Received').' '.session('code', 'vide')" />

            <x-text-input id="code" class="block mt-1 w-full"
                            type="password"
                            name="code"
                            required  />

            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <x-radio-input  id="cosnetmember" class="inline-block mt-1"  name="cosnetmember" required value="cosnetmember" 
                    :checked="old('cosnetmember') == 'cosnetmember' ? true : false"
                    @click="toggleMembershipId=true"  
                    />
                <x-input-label  for="cosnetmember" :value="__('Cosnet Member')" />
            </div>
            <div class="flex items-center gap-2">
                <x-radio-input  id="notcosnetmember" class="inline-block mt-1"  name="cosnetmember" required value="notcosnetmember" 
                    @click="toggleMembershipId=false" 
                    :checked="old('cosnetmember') == 'notcosnetmember' ? true : false"
                     />
                <x-input-label  for="notcosnetmember" :value="__('Not a Cosnet Member')" />
            </div>
        </div>

        <div id="div-membership-id" class="mt-4" x-show="toggleMembershipId">
            <x-input-label for="membershipid" :value="__('MembershipId If your are a Cosnet Member')" />

            <x-text-input id="membershipid" class="block mt-1 w-full"
                            type="text"
                            name="membershipid"
                            :value="old('membershipid')"
                             />

            <x-input-error :messages="$errors->get('membershipid')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Continue') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
