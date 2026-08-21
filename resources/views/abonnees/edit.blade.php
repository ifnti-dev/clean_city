<x-app-layout>

    <x-slot>
        <!-- <div class="flex flex-col items-center justify-center g-0 h-screen px-4"> -->
        <!-- card -->

        <!-- {{$errors}} -->
        <div class=" flex justify-center items-center bg-white  rounded-md shadow m-6 p-6 lg:flex ">
            <!-- card body -->
            <div class="p-2 w-full">
                <div class="flex justify-between items-baseline">
                    <h3 class="text-blue-700 font-medium text-2xl">
                       Mise a jour d'un Abonnement
                    </h3>

                    <div class="flex items-center justify-center mt-6 w-60">
                        <a href="{{ route('abonnements.index') }}">
                            <x-primary-button class="w-full justify-center">
                                {{ __("Liste d'abonnements") }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('abonnements.store') }}">
                    @csrf

                    <div class="flex gap-5 justify-between">

                        <div class="mt-4 w-full">
                            <x-input-label for="date_debut" :value="__('Date Debut')" />
                            <x-text-input id="date_debut" class="block mt-1 w-full" type="date" name="date_debut"
                                :value="old('date_debut',$abonnement->date_debut)" required autofocus autocomplete="family-name" />
                            <x-input-error :messages="$errors->get('date_debut')" class="mt-2" />
                        </div>

                        <div class="mt-4 w-full">
                            <x-input-label for="date_fin" :value="__('Date Fin')" />
                            <x-text-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin"
                                :value="old('date_fin',$abonnement->date_fin)" autocomplete="given-name" />
                            <x-input-error :messages="$errors->get('date_fin')" class="mt-2" />
                        </div>
                    </div>

                    <!-- le client -->
                    <div class="mt-4">
                        <x-input-label for="client" :value="__('Client')" />
                        <select name="client_id" id="client_id" class="w-full rounded-lg">
                            <option value="">Choisissez Le Client </option>
                            @foreach ( $clients as $client )
                            <option @selected($client->id==$abonnement->menage->client_id) value="{{ $client->id }}">{{ $client->user->nom }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('client->id')" class="mt-2" />
                    </div>

                    <!-- nom menage -->
                    <div class="mt-4">
                        <x-input-label for="designation" :value="__('Designation')" />
                        <x-text-input id="designation" class="block mt-1 w-full" type="text" name="designation"
                            :value="old('designation',$abonnement->menage->designation)" required autocomplete="give-name" />
                        <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                    </div>


                    <div class="flex gap-5 justify-between">
                        <div class="mt-4 w-full">
                            <x-input-label for="type_habitat" :value="__('Type Habitat')" />
                            <select name="type_habitat_id" id="type_habitat_id" class="w-full rounded-lg">
                                <option value="">Choisissez Le Type d'habitat </option>
                                @foreach ( $type_habitats as $type_habitat )
                                <option @selected($abonnement->menage->type_habitat_id ==$type_habitat->id) value="{{ $type_habitat->id }}">{{ $type_habitat->designation }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type_habitat_id')" class="mt-2" />
                        </div>

                        <div class="mt-4 w-full">
                            <x-input-label for="quartier" :value="__('Quartier')" />
                            <select name="quartier_id" id="quartier_id" class="w-full rounded-lg">
                                <option value="">Choisissez Le Quartier</option>
                                @foreach ( $quartiers as $quartier )
                                <option @selected($abonnement->menage->quartier_id==$quartier->id) value="{{ $quartier->id }}">{{ $quartier->designation }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('quartier_id')" class="mt-2" />
                        </div>

                    </div>




                    <div class="flex gap-5 justify-between">
                        <div class="mt-4 w-full">
                            <x-input-label for="longitude" :value="__('Longitude')" />
                            <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude"
                                :value="old('longitude',$abonnement->menage->longitude)" required autocomplete="give-name" />
                            <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                        </div>

                        <div class="mt-4 w-full">
                            <x-input-label for="latitude" :value="__('Latitude')" />
                            <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude"
                                :value="old('latitude',$abonnement->menage->latitude)" required autocomplete="give-name" />
                            <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                        </div>

                    </div>
                    <!-- Bouton -->
                    <div class="flex items-center justify-center mt-6 w-full ">
                        <x-primary-button class="w-full justify-center py-2 hover:bg-blue-500">
                            {{ __('Enregistrer') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
        <!-- </div> -->

        <!-- </div> -->

    </x-slot>
</x-app-layout>