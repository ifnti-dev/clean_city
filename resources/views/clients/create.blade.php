<x-app-layout>

    <x-slot>

         <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Ajouter un client
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('abonnements.create') }}">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Ajouter') }}
                            </x-secondary-button>
                        </a>
                    </div>
        </div>


        

        <div class=" card  mt-[-50px] p-5 mx-4 mb-6 ">
            <form method="POST" action="{{ route('clients.store') }}" >
            @csrf
            <div class="flex gap-5 justify-between">
                 <!-- Nom -->
                <div class="mt-4 w-full">
                    <x-input-label for="nom" :value="__('Nom')" />

                    <x-text-input
                        id="nom"
                        class="block mt-1 w-full"
                        type="text"
                        name="nom"
                        :value="old('nom')"
                        required
                        autofocus
                        placeholder="nom"
                        autocomplete="family-name"
                    />

                    <x-input-error
                        :messages="$errors->get('nom')"
                        class="mt-2"
                    />
                </div>

            <!-- Prénom -->
                <div class="mt-4 w-full">
                    <x-input-label for="prenom" :value="__('Prénom')" />

                    <x-text-input
                        id="prenom"
                        class="block mt-1 w-full"
                        type="text"
                        name="prenom"
                        :value="old('prenom')"
                        required
                        placeholder="prenom"
                        autocomplete="given-name"
                    />

                    <x-input-error
                        :messages="$errors->get('prenom')"
                        class="mt-2"
                    />
                </div>
            </div>
           
            <div class="flex gap-5 justify-between">
                <!-- Contact -->
                <div class="mt-4 w-full">
                    <x-input-label for="contacte" :value="__('Contact')" />

                    <x-text-input
                        id="contacte"
                        class="block mt-1 w-full"
                        type="text"
                        name="contacte"
                        :value="old('contacte')"
                        required
                        placeholder="cotacte"
                        autocomplete="tel"
                    />

                    <x-input-error
                        :messages="$errors->get('contacte')"
                        class="mt-2"
                    />
                </div>

                <!-- Email -->
                <div class="mt-4 w-full" >
                    <x-input-label for="email" :value="__('Email')" />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        placeholder="email"
                        autocomplete="username"
                    />

                    <x-input-error
                        :messages="$errors->get('email')"
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

