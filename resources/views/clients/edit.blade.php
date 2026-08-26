<x-app-layout>

    <x-slot class="">
    <div class="flex justify-center items-center mb-6">
        <h3 class="text-blue-700 font-bold pt-7 text-2xl">
           Editer un client
        </h3>
    </div>

    <div class="bg-white  rounded-md shadow m-6 p-6">
        <form action="{{ route('clients.update', $client->id) }}" method="POST" >
            @csrf
            @method('PUT')
            <div class="flex gap-5 justify-between">
                <div class="mt-4 w-full">
                    <x-input-label for="nom" :value="__('Nom')" />

                    <x-text-input
                        id="nom"
                        class="block mt-1 w-full"
                        type="text"
                        name="nom"
                        value="{{ old('nom',  $client->user->nom) }}"
                        required
                        autofocus
                        autocomplete="family-name"
                    />

                    <x-input-error
                        :messages="$errors->get('nom')"
                        class="mt-2"
                    />
                </div>

                <div class="mt-4 w-full">
                    <x-input-label for="prenom" :value="__('Prénom')" />

                    <x-text-input
                        id="prenom"
                        class="block mt-1 w-full"
                        type="text"
                        name="prenom"
                        value="{{ old('prenom',  $client->user->prenom) }}"
                        required
                        autocomplete="given-name"
                    />

                    <x-input-error
                        :messages="$errors->get('prenom')"
                        class="mt-2"
                    />
                </div>
            </div>
            <!-- Nom -->
            

            <!-- Prénom -->
           

            <!-- Contact -->
            <div class="flex gap-5 justify-between">
                <div class="mt-4 w-full">
                    <x-input-label for="contacte" :value="__('Contact')" />

                    <x-text-input
                        id="contacte"
                        class="block mt-1 w-full"
                        type="text"
                        name="contacte"
                        value="{{ old('contacte',  $client->user->contacte) }}"
                        required
                        autocomplete="tel"
                    />

                    <x-input-error
                        :messages="$errors->get('contacte')"
                        class="mt-2"
                    />
                </div>

                <div class="mt-4 w-full">
                    <x-input-label for="email" :value="__('Email')" />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        value="{{ old('email',  $client->user->email) }}"
                        required
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