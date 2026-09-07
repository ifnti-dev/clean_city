<x-app-layout>
    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl"> Mise à jour d'un Tarif
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('tarifs.index') }}">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Listes') }}
                            </x-secondary-button>
                        </a>
                    </div>
                </div>

                <form class="card  mt-[-50px] p-5 mx-4 mb-6" method="POST" action="{{ route('tarifs.update', $tarif->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2">

                        {{-- Désignation --}}
                        <div class="mt-4 w-full">

                            <x-input-label for="designation" :value="__('Désignation')" />

                            <x-text-input id="designation" class="block mt-1 w-full" type="text" name="designation"
                                :value="old('designation', $tarif->designation)" required autofocus />

                            <x-input-error :messages="$errors->get('designation')" class="mt-2" />

                        </div>


                        {{-- Montant --}}
                        <div class="mt-4 w-full">

                            <x-input-label for="montant" :value="__('Montant')" />

                            <x-text-input id="montant" class="block mt-1 w-full" type="number" name="montant" min="0"
                                :value="old('montant', $tarif->montant)" required />

                            <x-input-error :messages="$errors->get('montant')" class="mt-2" />

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