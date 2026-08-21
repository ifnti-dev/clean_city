<x-app-layout>



    <x-slot>
        <div class="flex justify-center items-center mb-6">
            <h3 class="text-blue-700 font-bold text-xl">
                Creation d'un abonnement
            </h3>
        </div>

        <form method="POST" action="{{ route('abonnees.store') }}">
            @csrf

            <div class="flex gap-1 justify-between">

                <div class="mt-4">
                    <x-input-label for="date_debut" :value="__('Date debut')" />
                    <x-text-input id="date_debut" class="block mt-1 w-full" type="date" name="date_debut"
                        :value="old('date_debut')" required autofocus autocomplete="family-name" />
                    <x-input-error :messages="$errors->get('date_debut')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="date_fin" :value="__('date_fin')" />
                    <x-text-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin"
                        :value="old('date_fin')" autocomplete="given-name" />
                    <x-input-error :messages="$errors->get('date_fin')" class="mt-2" />
                </div>
            </div>

            <!-- le client -->
            <div class="mt-4">
                <x-input-label for="client" :value="__('Client')" />
                <select name="client_id" id="client_id" class="w-full rounded-lg">
                    @foreach ( $clients as $client )
                    <option value="{{ $client->user_id }}">{{ $client->user->nom }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('client')" class="mt-2" />
            </div>

            <!-- nom menage -->
            <div class="mt-4">
                <x-input-label for="designation" :value="__('designation')" />
                <x-text-input id="designation" class="block mt-1 w-full" type="text" name="designation"
                    :value="old('designation','nassam')" required autocomplete="give-name" />
                <x-input-error :messages="$errors->get('designation')" class="mt-2" />
            </div>


            <div class="mt-4">
                <x-input-label for="longitude" :value="__('longitude')" />
                <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude"
                    :value="old('longitude',1242)" required autocomplete="give-name" />
                <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="latitude" :value="__('latitude')" />
                <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude"
                    :value="old('latitude',454)" required autocomplete="give-name" />
                <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
            </div>


            <!-- Bouton -->
            <div class="flex items-center justify-center mt-6 w-full ">
                <x-primary-button class="w-full justify-center py-2">
                    {{ __('Enregistrer') }}
                </x-primary-button>
            </div>

        </form>
    </x-slot>

    </x-guest-layout>