
    
    <x-guest-layout>

        <div class="flex justify-center items-center mb-6">
            <h3 class="text-blue-700 font-bold text-xl">
               Ajouter un client
            </h3>
        </div>

        <form method="POST" action="{{ route('clients.store') }}">
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
                    autocomplete="username"
                />

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2"
                />
            </div>

            <!-- Mot de passe -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mot de passe')" />

                <x-text-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />

                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />
            </div>

            <!-- Confirmation du mot de passe -->
            <div class="mt-4">
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
                    autocomplete="new-password"
                />

                <x-input-error
                    :messages="$errors->get('password_confirmation')"
                    class="mt-2"
                />
            </div>


            

            <!-- Bouton -->
            <div class="flex items-center justify-center mt-6 w-full">
                <x-primary-button class="w-full justify-center rounded rounded-5">
                    {{ __('Enregistrer') }}
                </x-primary-button>
            </div>


        </form>

    </x-guest-layout>

