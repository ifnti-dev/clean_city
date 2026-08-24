<x-app-layout>

    <x-slot class="">

        <div class="flex justify-center items-center mb-6 " >
            <h3 class="text-blue-700 font-bold pt-7 pr-2 text-2xl">
               Ajouter un client
            </h3>
        </div>

        <div class="bg-white  rounded-md shadow m-6 p-6">
            <form method="POST" action="{{ route('clients.store') }}" >
            @csrf
            <!-- Nom -->
            <div class="mt-4">
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
            <div class="mt-4">
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

            <!-- Contact -->
            <div class="mt-4">
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
            <div class="mt-4">
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

            <div class="flex gap-5 justify-between">
                <!-- Mot de passe -->
                <div class="mt-4 w-full">
                    <x-input-label for="password" :value="__('Mot de passe')" />

                    <x-text-input
                        id="password"
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required
                        placeholder="............."
                        autocomplete="new-password"
                    />

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2"
                    />
                </div>

                <!-- Confirmation du mot de passe -->
                <div class="mt-4 w-full">
                    <x-input-label
                        for="password_confirmation"
                        :value="__('Confirmation du mot de passe')"
                    />

                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="............."
                        autocomplete="new-password"
                    />

                    <x-input-error
                        :messages="$errors->get('password_confirmation')"
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

