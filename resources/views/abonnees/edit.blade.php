<x-app-layout>

    <x-slot>

        <div class="flex justify-center items-center bg-white rounded-md shadow m-6 p-6 lg:flex">
            <div class="p-2 w-full">

                <div class="flex flex-col sm:flex-row justify-between items-baseline gap-4">
                    <h3 class="text-blue-700 font-medium text-2xl max-sm:text-lg">
                        Mise à jour d'un Abonnement
                    </h3>

                    <div class="flex items-center justify-center mt-6 sm:mt-0 w-60 max-sm:w-full">
                        <a href="{{ route('abonnements.index') }}" class="w-full">
                            <x-primary-button class="w-full justify-center">
                                {{ __("Liste d'abonnements") }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('abonnements.update', $abonnement) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2">

                        <div class="mt-4 w-full">
                            <x-input-label for="date_debut" :value="__('Date Debut')" />
                            <x-text-input
                                id="date_debut"
                                class="block mt-1 w-full"
                                type="date"
                                name="date_debut"
                                :value="old('date_debut', $abonnement->date_debut)"
                                required
                                autofocus
                            />
                            <x-input-error :messages="$errors->get('date_debut')" class="mt-2" />
                        </div>

                        <div class="mt-4 w-full">
                            <x-input-label for="date_fin" :value="__('Date Fin')" />
                            <x-text-input
                                id="date_fin"
                                class="block mt-1 w-full"
                                type="date"
                                name="date_fin"
                                :value="old('date_fin', $abonnement->date_fin)"
                            />
                            <x-input-error :messages="$errors->get('date_fin')" class="mt-2" />
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2">

                        <div class="mt-4 w-full">
                            <x-input-label for="client_id" :value="__('Client')" />

                            <select
                                name="client_id"
                                id="client_id"
                                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Choisissez Le Client</option>

                                @foreach ($clients as $client)
                                    <option
                                        @selected(old('client_id', $abonnement->menage->client_id) == $client->id)
                                        value="{{ $client->id }}"
                                    >
                                        {{ $client->user->nom }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                        </div>

                        <div class="mt-4 w-full">
                            <x-input-label for="tarif_id" :value="__('Tarif')" />

                            <select
                                name="tarif_id"
                                id="tarif_id"
                                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Choisissez Le Tarif</option>

                                @foreach ($tarifs as $tarif)
                                    <option
                                        @selected(old('tarif_id', $abonnement->tarif_id) == $tarif->id)
                                        value="{{ $tarif->id }}"
                                    >
                                        {{ $tarif->designation }} ({{ $tarif->montant }} Fcfa)
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('tarif_id')" class="mt-2" />
                        </div>

                    </div>

                    <div class="mt-4">
                        <x-input-label for="designation" :value="__('Designation')" />

                        <x-text-input
                            id="designation"
                            class="block mt-1 w-full"
                            type="text"
                            name="designation"
                            :value="old('designation', $abonnement->menage->designation)"
                            required
                        />

                        <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2">

                        <div class="mt-4 w-full">
                            <x-input-label for="type_habitat_id" :value="__('Type Habitat')" />

                            <select
                                name="type_habitat_id"
                                id="type_habitat_id"
                                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Choisissez Le Type d'habitat</option>

                                @foreach ($type_habitats as $type_habitat)
                                    <option
                                        @selected(old('type_habitat_id', $abonnement->menage->type_habitat_id) == $type_habitat->id)
                                        value="{{ $type_habitat->id }}"
                                    >
                                        {{ $type_habitat->designation }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('type_habitat_id')" class="mt-2" />
                        </div>

                        <div class="mt-4 w-full">
                            <x-input-label for="quartier_id" :value="__('Quartier')" />

                            <select
                                name="quartier_id"
                                id="quartier_id"
                                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Choisissez Le Quartier</option>

                                @foreach ($quartiers as $quartier)
                                    <option
                                        @selected(old('quartier_id', $abonnement->menage->quartier_id) == $quartier->id)
                                        value="{{ $quartier->id }}"
                                    >
                                        {{ $quartier->designation }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('quartier_id')" class="mt-2" />
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2">

                        <div class="mt-4 w-full">
                            <x-input-label for="longitude" :value="__('Longitude')" />

                            <x-text-input
                                id="longitude"
                                class="block mt-1 w-full"
                                type="text"
                                name="longitude"
                                :value="old('longitude', $abonnement->menage->longitude)"
                                required
                            />

                            <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                        </div>

                        <div class="mt-4 w-full">
                            <x-input-label for="latitude" :value="__('Latitude')" />

                            <x-text-input
                                id="latitude"
                                class="block mt-1 w-full"
                                type="text"
                                name="latitude"
                                :value="old('latitude', $abonnement->menage->latitude)"
                                required
                            />

                            <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                        </div>

                    </div>

                    <div class="flex items-center justify-center mt-6 w-full">
                        <x-primary-button class="w-full justify-center py-2 hover:bg-blue-500">
                            {{ __('Modifier') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>

    </x-slot>

</x-app-layout>