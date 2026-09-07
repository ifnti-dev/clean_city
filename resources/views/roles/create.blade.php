<x-app-layout>

    <x-slot>

        <div class="w-full ">
            <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                <div class="flex justify-between  items-baseline ">
                    <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Ajouter un role
                    </h1>
                </div>

                <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                    <a href="{{ route('roles.index') }}">
                        <x-secondary-button
                            class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                            {{ __('Liste') }}
                        </x-secondary-button>
                    </a>
                </div>
            </div>
        </div>
        

        <div class=" card  mt-[-50px] p-5 mx-4 mb-6 ">
            <form method="POST" action="{{ route('roles.store') }}" >
                @csrf
                <div class="flex gap-5 justify-between">
                    <!-- Role -->
                    <div class="mt-4 w-full">
                        <x-input-label for="nom" :value="__('Role')" />

                        <x-text-input
                            id="role"
                            class="block mt-1 w-full"
                            type="text"
                            name="role"
                            :value="old('role')"
                            required
                            autofocus
                            placeholder="role"
                            autocomplete="family-name"
                        />

                        <x-input-error
                            :messages="$errors->get('role')"
                            class="mt-2"
                        />
                    </div>
                </div>

            
                


                <!-- Bouton -->
                <div class="flex items-center justify-end ml-auto mt-6 w-40">
                    <x-primary-button class="w-full justify-center">
                        {{ __('Enregistrer') }}
                    </x-primary-button>
                </div>

      
            </form>
        </div>
        
    </x-slot>

</x-app-layout>

