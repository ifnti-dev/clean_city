<x-app-layout>
    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl"> Creer un Ramassage
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('ramassages.index') }}">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Listes') }}
                            </x-secondary-button>
                        </a>
                    </div>
                </div>


                <form class="card  mt-[-50px] p-5 mx-4 mb-6" method="POST" action="{{ route('ramassages.store') }}">


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
                                @foreach ( $users as $user )
                                <option @selected(old('employe_id')==$user->employe->id) value="{{ $user->employe->id }}">{{
                                    $user->nom   }} ({{$user->contacte}}) </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('employe_id')" class="mt-2" />
                        </div>


                    </div>


                    <!-- Bouton -->
                    <div class="flex items-center justify-end mt-6 w-full ">
                        <x-primary-button class="flex w-52 justify-center py-2 hover:bg-blue-500">
                            {{ __('Enregistrer') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>

    </x-slot>
</x-app-layout>