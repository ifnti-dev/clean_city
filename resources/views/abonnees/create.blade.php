<x-app-layout>
    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl"> Ajout d'un Abonnement
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('abonnements.index') }}">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Listes') }}
                            </x-secondary-button>
                        </a>
                    </div>
                </div>


                <form class="card  mt-[-50px] p-5 mx-4 mb-6" method="POST" action="{{ route('abonnements.store') }}">
                    @csrf
                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2 ">

                        <!-- le client -->
                        <div class="mt-4">
                            <x-input-label for="client" :value="__('Client')" />
                            <select name="client_id" id="client_id" class="w-full rounded-lg">
                                <option value="">Choisissez Le Client </option>
                                @foreach ( $clients as $client )
                                <option @selected(old('client_id')==$client->id) value="{{ $client->id }}">{{
                                    $client->user->nom }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                        </div>
                        <!-- nom menage -->
                        <div class="mt-4 w-full">
                            <x-input-label for="designation" :value="__('Designation')" />
                            <x-text-input id="designation" class="block mt-1 w-full" type="text" name="designation"
                                :value="old('designation','nassam')" required autocomplete="give-name" />
                            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                        </div>
                    </div>



                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2 ">
                        <div class="mt-4 w-full">
                            <x-input-label for="type_habitat" :value="__('Type Habitat')" />
                            <select name="type_habitat_id" id="type_habitat_id" class="w-full rounded-lg">
                                <option value="">Choisissez Le Type d'habitat </option>
                                @foreach ( $type_habitats as $type_habitat )
                                <option @selected(old('type_habitat_id')==$type_habitat->id) value="{{ $type_habitat->id
                                    }}">{{ $type_habitat->designation }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type_habitat_id')" class="mt-2" />
                        </div>

                        <div class="mt-4 w-full">
                            <x-input-label for="quartier" :value="__('Quartier')" />
                            <select name="quartier_id" id="quartier_id" class="w-full rounded-lg">
                                <option value="">Choisissez Le Quartier</option>
                                @foreach ( $quartiers as $quartier )
                                <option @selected(old('quartier_id')==$quartier->id) value="{{ $quartier->id }}">{{
                                    $quartier->designation }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('quartier_id')" class="mt-2" />
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2 ">
                        <div class="mt-4 w-full">
                            <x-input-label for="longitude" :value="__('Longitude')" />
                            <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude"
                                :value="old('longitude',1242)" required autocomplete="give-name" />
                            <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                        </div>

                        <div class="mt-4 w-full">
                            <x-input-label for="latitude" :value="__('Latitude')" />
                            <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude"
                                :value="old('latitude',454)" required autocomplete="give-name" />
                            <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                        </div>
                    </div>

                    <!-- <div class="flex items-center justify-center mt-6 w-full ">
                        <x-secondary-button onclick="getlocalisation()" type="button"
                            class="bg-yellow-600 text-xl py-4 text-white border-yellow-600 hover:bg-yellow-500 hover:border-yellow-600 focus:ring-0">
                            {{ __(' Utiliser ma position actuelle') }}
                        </x-secondary-button>
                       
                    </div> -->
                     <!-- 📍 -->

                    <!-- Bouton -->
                    <div class="flex items-center justify-end mt-6 w-full ">
                        <x-primary-button class="w-52 justify-center py-2 hover:bg-blue-500">
                            {{ __('Enregistrer') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>


        <script>
            function getlocalisation() {
                // Verifier si le navigateur supporte la localisation
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            document.getElementById('latitude').value = position.coords.latitude;
                            document.getElementById('longitude').value = position.coords.longitude;
                        },
                        (error) => {
                            // gestion des erreurs 
                            let message = "Erreur de géolocalisation : ";
                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    message += "Vous devez autoriser l'accès à la position.";
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    message += "La position n'est pas disponible.";
                                    break;
                                case error.TIMEOUT:
                                    message += "Le temps d'attente est écoulé.";
                                    break;
                            }
                            alert(message);
                        }
                    );
                } else {
                    alert("Votre navigateur ne supporte pas la géolocalisation.");
                }
            }
        </script>


    </x-slot>
</x-app-layout>