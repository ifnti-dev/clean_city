<x-app-layout>

    <x-slot>

        <div class="flex justify-center items-center bg-white rounded-md shadow m-6 p-6">

            <div class="p-2 w-full">

                {{-- En-tête --}}
                <div class="flex justify-between items-baseline">

                    <h3 class="text-blue-700 font-medium text-2xl max-sm:text-lg">
                        Modification d'un Tarif
                    </h3>

                    <div class="flex items-center justify-end mt-6 w-60 max-sm:w-full">

                        <a href="{{ route('tarifs.index') }}">

                            <x-primary-button class="w-full justify-center max-sm:py-2 max-sm:text-sm">
                                {{ __('Liste') }}
                            </x-primary-button>

                        </a>

                    </div>

                </div>


                {{-- Formulaire --}}
                <form method="POST" action="{{ route('tarifs.update', $tarif->id) }}">

                    @csrf
                    @method('PUT')


                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2">

                        {{-- Désignation --}}
                        <div class="mt-4 w-full">

                            <x-input-label
                                for="designation"
                                :value="__('Désignation')"
                            />

                            <x-text-input
                                id="designation"
                                class="block mt-1 w-full"
                                type="text"
                                name="designation"
                                :value="old('designation', $tarif->designation)"
                                required
                                autofocus
                            />

                            <x-input-error
                                :messages="$errors->get('designation')"
                                class="mt-2"
                            />

                        </div>


                        {{-- Montant --}}
                        <div class="mt-4 w-full">

                            <x-input-label
                                for="montant"
                                :value="__('Montant')"
                            />

                            <x-text-input
                                id="montant"
                                class="block mt-1 w-full"
                                type="number"
                                name="montant"
                                min="0"
                                :value="old('montant', $tarif->montant)"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('montant')"
                                class="mt-2"
                            />

                        </div>

                    </div>


                    {{-- Bouton --}}
                    <div class="flex items-center justify-center mt-6 w-full">

                        <x-primary-button
                            class="w-full justify-center py-2 hover:bg-blue-500">

                            {{ __('Modifier') }}

                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>

    </x-slot>

</x-app-layout>