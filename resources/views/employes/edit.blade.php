<x-app-layout>

    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl"> Mise a jour d'un Employé
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('employes.index') }}">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Listes') }}
                            </x-secondary-button>
                        </a>
                    </div>
                </div>


                <form class="card  mt-[-50px] p-5 mx-4 mb-6" method="POST" action="{{ route('employes.update', $employe->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2">

                        <div class="mt-4 w-full">

                            <x-input-label for="nom" :value="__('Nom')" />

                            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="old('nom', $employe->user->nom)" required autofocus />

                            <x-input-error :messages="$errors->get('nom')" class="mt-2" />

                        </div>


                        <div class="mt-4 w-full">

                            <x-input-label for="prenom" :value="__('Prénom')" />

                            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom"
                                :value="old('prenom', $employe->user->prenom)" required />

                            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />

                        </div>

                    </div>


                    <div class="grid grid-cols-2 gap-5 max-sm:grid-cols-1 max-sm:gap-2">

                        <div class="mt-4 w-full">

                            <x-input-label for="contacte" :value="__('Contact')" />

                            <x-text-input id="contacte" class="block mt-1 w-full" type="text" name="contacte"
                                :value="old('contacte', $employe->user->contacte)" required />

                            <x-input-error :messages="$errors->get('contacte')" class="mt-2" />

                        </div>


                        <div class="mt-4 w-full">

                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email', $employe->user->email)" required />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        </div>

                    </div>


                    <div class="mt-4 w-full">

                        <x-input-label for="role" :value="__('Rôle')" />

                        <select name="role" id="role" class="w-full rounded-lg border-gray-300" required>

                            <option value="">
                                Choisissez le rôle
                            </option>

                            @foreach ($roles as $role)

                            <option value="{{ $role->name }}" @selected( old( 'role' , $employe->
                                user->roles->first()?->name
                                ) == $role->name
                                )
                                >
                                {{ $role->name }}
                            </option>

                            @endforeach

                        </select>

                        <x-input-error :messages="$errors->get('role')" class="mt-2" />

                    </div>


                    <div class="flex items-center justify-end mt-6 w-full">

                        <x-primary-button class="w-52 justify-center py-2 hover:bg-blue-500">

                            {{ __('Modifier') }}

                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>

    </x-slot>

</x-app-layout>