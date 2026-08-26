<x-app-layout>

    <x-slot>
        <!-- {{$errors}} -->
        <div class=" flex justify-center items-center bg-white  rounded-md shadow m-6 p-6 lg:flex ">
            <!-- card body -->
            <div class="p-2 w-full ">
                <div class="flex justify-between  items-baseline ">
                    <h3 class="text-blue-700 font-medium text-2xl  max-sm:text-lg">
                        Creer un Ramassage
                    </h3>

                    <div class="flex items-center justify-end  mt-6 w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('ramassages.index') }}">
                            <x-primary-button class="w-full justify-center max-sm:py-2 max-sm:text-sm">
                                {{ __("Listes") }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('ramassages.store') }}">
                    @csrf

                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2 ">
                        <div class="mt-4 w-full">
                            <x-input-label for="date" :value="__('Date de Ramassage')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date"
                                :value="old('date')" required autofocus autocomplete="family-name" />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <!-- l'employer -->
                        <div class="mt-4 w-full">
                            <x-input-label for="zone" :value="__('Zone')" />
                            <select name="zone_id" id="zone_id" class="w-full rounded-lg">
                                <option value="">Choisissez La Zone </option>
                                @foreach ( $zones as $zone )
                                <option @selected(old('zone_id')==$zone->id) value="{{ $zone->id }}">{{
                                    $zone->designation}} </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('zone_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2 ">


                        <div class="mt-4">
                            <x-input-label for="employe" :value="__('Employe')" />
                            <select name="employe_id" id="employe_id" class="w-full rounded-lg">
                                <option value="">Choisissez Le employe </option>
                                @foreach ( $employes as $employe )
                                <option @selected(old('employe_id')==$employe->id) value="{{ $employe->id }}">{{
                                    $employe->user->nom }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('employe_id')" class="mt-2" />
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

    </x-slot>
</x-app-layout>