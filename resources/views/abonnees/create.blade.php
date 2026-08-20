<x-guest-layout>

    <div class="flex justify-center items-center mb-6">
        <h3 class="text-blue-700 font-bold text-xl">
            Creation d'un abonnement
        </h3>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div class="mt-4">
            <x-input-label for="date_debut" :value="__('Date debut')" />

            <x-text-input
                id="date_debut"
                class="block mt-1 w-full"
                type="date"
                name="date_debut"
                :value="old('date_debut')"
                required
                autofocus
                autocomplete="family-name"
            />

            <x-input-error
                :messages="$errors->get('date_debut')"
                class="mt-2"
            />
        </div>

        <!-- Prénom -->
        <div class="mt-4">
            <x-input-label for="date_fin" :value="__('date_fin')" />

            <x-text-input
                id="date_fin"
                class="block mt-1 w-full"
                type="date"
                name="date_fin"
                :value="old('date_fin')"
                autocomplete="given-name"
            />

            <x-input-error
                :messages="$errors->get('date_fin')"
                class="mt-2"
            />
        </div>

        <!-- Contact -->
        <div class="mt-4">
            <x-input-label for="client" :value="__('Client')" />

            
            <select name="client_id" id="client_id">
                @foreach ( $clients as $client )
                    <option value="{{ $client->user_id }}">{{ $client->user->nom }}</option>
                @endforeach    
            </select>


            <x-input-error
                :messages="$errors->get('client')"
                class="mt-2"
            />
        </div>

        

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="menage" :value="__('Menage')" />

            <x-text-input
                id="menage"
                class="block mt-1 w-full"
                type="text"
                name="menage"
                :value="old('menage')"
                required
                autocomplete="give-name"
            />

            <x-input-error
                :messages="$errors->get('menage')"
                class="mt-2"
            />
        </div>



        <!-- Bouton -->
        <div class="flex items-center justify-center mt-6 w-full">
            <x-primary-button class="w-full justify-center">
                {{ __('Enregistrer') }}
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>