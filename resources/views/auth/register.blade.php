<x-guest-layout>


    <div class=" flex justify-center items-center">
        <h3 class="text-blue-700  font-bold">Inscription</h3>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div class="mt-4">
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom', 'ganietou')"
                required autofocus autocomplete="nom" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Prenom -->
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prenom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom', 'gani')"
                required autofocus autocomplete="prenom" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>


        <!-- Contacte -->
        <div class="mt-4">
            <x-input-label for="contacte" :value="__('Contacte')" />
            <x-text-input id="contacte" class="block mt-1 w-full" type="text" name="contacte"
                :value="old('contacte', '90255777')" required autofocus autocomplete="contacte" />
            <x-input-error :messages="$errors->get('contacte')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email', 'ganietou@gmail.com')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4 w-full">
            <x-primary-button class=" w-full">
                {{ __('Enregistrer') }}
            </x-primary-button>
        </div>

        <div class="flex justify-between mb-4 mt-4 w-full">
            <p> Vous avez un compte ?.</p>
            <a class="underline text-ld text-blue-700"
                href="{{ route('login') }}">
               
                {{ __('Se connecter') }}
            </a>
        </div>
    </form>
</x-guest-layout>