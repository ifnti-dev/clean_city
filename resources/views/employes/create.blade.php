<x-app-layout>

    <x-slot>

        <div class="flex justify-center items-center bg-white rounded-md shadow m-6 p-6">

            <!-- {{$errors}} -->
            <div class="p-2 w-full">

                <div class="flex justify-between items-baseline">

                    <h3 class="text-blue-700 font-medium text-2xl max-sm:text-lg">
                        Ajout d'un Employé
                    </h3>

                    <div class="flex items-center justify-end mt-6 w-60 max-sm:w-full">

                        <a href="{{ route('employes.index') }}">

                            <x-primary-button class="w-full justify-center max-sm:py-2 max-sm:text-sm">
                                {{ __('Liste') }}
                            </x-primary-button>

                        </a>

                    </div>

                </div>

                <form method="POST" action="{{ route('employes.store') }}">

                    @csrf

                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2">

                        <div class="mt-4 w-full">

                            <x-input-label for="nom" :value="__('Nom')" />

                            <x-text-input
                                id="nom"
                                class="block mt-1 w-full"
                                type="text"
                                name="nom"
                                :value="old('nom')"
                                required
                                autofocus
                            />

                            <x-input-error
                                :messages="$errors->get('nom')"
                                class="mt-2"
                            />

                        </div>

                        <div class="mt-4 w-full">

                            <x-input-label for="prenom" :value="__('Prénom')" />

                            <x-text-input
                                id="prenom"
                                class="block mt-1 w-full"
                                type="text"
                                name="prenom"
                                :value="old('prenom')"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('prenom')"
                                class="mt-2"
                            />

                        </div>

                    </div>


                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2">

                        <div class="mt-4 w-full">

                            <x-input-label for="contacte" :value="__('Contact')" />

                            <x-text-input
                                id="contacte"
                                class="block mt-1 w-full"
                                type="text"
                                name="contacte"
                                :value="old('contacte')"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('contacte')"
                                class="mt-2"
                            />

                        </div>


                        <div class="mt-4 w-full">

                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input
                                id="email"
                                class="block mt-1 w-full"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="mt-2"
                            />

                        </div>

                    </div>


                    <div class="mt-4 w-full">

                        <x-input-label for="role" :value="__('Rôle')" />

                        <select
                            name="role"
                            id="role"
                            class="w-full rounded-lg border-gray-300"
                            required
                        >

                            <option value="">
                                Choisissez le rôle
                            </option>

                            @foreach ($roles as $role)

                                <option
                                    value="{{ $role->name }}"
                                    @selected(old('role') == $role->name)
                                >
                                    {{ $role->name }}
                                </option>

                            @endforeach

                        </select>

                        <x-input-error
                            :messages="$errors->get('role')"
                            class="mt-2"
                        />

                    </div>


                    <div class="flex items-center justify-center mt-6 w-full">

                        <x-primary-button class="w-full justify-center py-2 hover:bg-blue-500">
                            {{ __('Enregistrer') }}
                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>

    </x-slot>

</x-app-layout>