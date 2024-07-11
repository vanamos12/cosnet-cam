<x-tailadmin-layout>
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
                Update Member
            </h3>
            </div>
            <form method="POST" action="{{ route('member.update', $member) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <input id="defaultDate" type="hidden" value="{{$member->birthday}}"/>
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
                    :value="$member->first_name"
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
                    :value="$member->last_name"
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
                    :value="$member->email"
                    required
                    autofocus
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4.5">
                <x-input-label-t for="town">
                    Town <span class="text-meta-1">*</span>
                </x-input-label-t>
                <x-text-input-t
                    id="town"
                    type="text"
                    name="town"
                    placeholder="Enter your town"
                    :value="$member->town"
                    required
                    autofocus
                />
                <x-input-error :messages="$errors->get('town')" class="mt-2" />
                </div>
                <div class="mb-4.5">
                    <div>
                      <x-input-label-t
                        for="birthday"
                      >
                        Birthday<span class="text-meta-1">*</span>
                      </x-input-label-t>
                      <div class="relative">
                          
                        
                        <input
                          id="birthday"
                          name="birthday"
                          type="date"
                          class="form-datepicker w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                          placeholder="yyyy-mm-dd"
                          data-class="flatpickr-right"
                        />

                        <div
                          class="pointer-events-none absolute inset-0 left-auto right-5 flex items-center"
                        >
                          <svg
                            width="18" 
                            height="18"
                            viewBox="0 0 18 18"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M15.7504 2.9812H14.2879V2.36245C14.2879 2.02495 14.0066 1.71558 13.641 1.71558C13.2754 1.71558 12.9941 1.99683 12.9941 2.36245V2.9812H4.97852V2.36245C4.97852 2.02495 4.69727 1.71558 4.33164 1.71558C3.96602 1.71558 3.68477 1.99683 3.68477 2.36245V2.9812H2.25039C1.29414 2.9812 0.478516 3.7687 0.478516 4.75308V14.5406C0.478516 15.4968 1.26602 16.3125 2.25039 16.3125H15.7504C16.7066 16.3125 17.5223 15.525 17.5223 14.5406V4.72495C17.5223 3.7687 16.7066 2.9812 15.7504 2.9812ZM1.77227 8.21245H4.16289V10.9968H1.77227V8.21245ZM5.42852 8.21245H8.38164V10.9968H5.42852V8.21245ZM8.38164 12.2625V15.0187H5.42852V12.2625H8.38164V12.2625ZM9.64727 12.2625H12.6004V15.0187H9.64727V12.2625ZM9.64727 10.9968V8.21245H12.6004V10.9968H9.64727ZM13.8379 8.21245H16.2285V10.9968H13.8379V8.21245ZM2.25039 4.24683H3.71289V4.83745C3.71289 5.17495 3.99414 5.48433 4.35977 5.48433C4.72539 5.48433 5.00664 5.20308 5.00664 4.83745V4.24683H13.0504V4.83745C13.0504 5.17495 13.3316 5.48433 13.6973 5.48433C14.0629 5.48433 14.3441 5.20308 14.3441 4.83745V4.24683H15.7504C16.0316 4.24683 16.2566 4.47183 16.2566 4.75308V6.94683H1.77227V4.75308C1.77227 4.47183 1.96914 4.24683 2.25039 4.24683ZM1.77227 14.5125V12.2343H4.16289V14.9906H2.25039C1.96914 15.0187 1.77227 14.7937 1.77227 14.5125ZM15.7504 15.0187H13.8379V12.2625H16.2285V14.5406C16.2566 14.7937 16.0316 15.0187 15.7504 15.0187Z"
                              fill="#64748B"
                            />
                          </svg>
                        </div>
                      </div>
                      <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                    </div>
                </div>

                <div class="mb-4.5">
                <x-input-label-t for="cni_number">
                    CNI Number
                </x-input-label-t>
                <x-text-input-t
                    id="cni_number"
                    type="text"
                    name="cni_number"
                    placeholder="Enter your cni number"
                    :value="$member->cni_number"
                    autofocus
                />
                <x-input-error :messages="$errors->get('cni_number')" class="mt-2" />
                </div>

                <div class="mb-4.5">
                    
                    <div>
                      <x-input-label-t
                        for="cni_recto"
                      >
                        CNI Recto
                      </x-input-label-t>
                      @if($member->cni_recto)
                        <img src="{{ Storage::url($member->cni_recto) }}" class="w-16 mb-3" alt=""/>
                      @endif
                      <input
                        id="cni_recto"
                        name="cni_recto"
                        type="file"
                        class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary"
                      />
                      <x-input-error :messages="$errors->get('cni_recto')" class="mt-2" />
                    </div>
                </div>

                <div class="mb-4.5">
                    <div>
                      <x-input-label-t
                       for="cni_verso"
                      >
                        CNI Verso
                      </x-input-label-t>
                      @if($member->cni_verso)
                        <img src="{{ Storage::url($member->cni_verso) }}" class="w-16 mb-3" alt=""/>
                      @endif
                      <input
                        id="cni_verso"
                        name="cni_verso"
                        type="file"
                        class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary"
                      />
                      <x-input-error :messages="$errors->get('cni_verso')" class="mt-2" />
                    </div>
                </div>

                

                <button
                class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90"
                >
                Update Member
                </button>
            </div>
            </form>
        </div>
        </div>
    </div>  
</x-tailadmin-layout>