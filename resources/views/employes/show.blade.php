<x-app-layout>

    <x-slot>

        <div class="m-6 max-sm:m-3">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- En-tête --}}
                <div class=" px-6 py-10 border-b border-gray-100 flex justify-between items-center max-sm:flex-col max-sm:items-start max-sm:gap-4">

                    <div class="flex flex-col gap-1 py-5">
                        <h3 class="text-2xl font-semibold text-blue-700 max-sm:text-xl">
                            Détails de l'employé
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Consultez les informations de cet employé
                        </p>
                    </div>

                    <div class="flex items-center gap-2">

                        <a href="{{ route('employes.edit', $employe->id) }}">
                            <x-primary-button class="px-5">
                                Modifier
                            </x-primary-button>
                        </a>

                        <a href="{{ route('employes.index') }}">
                            <x-secondary-button class="px-5">
                                <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                                Retour
                            </x-secondary-button>
                        </a>

                    </div>

                </div>


                <div class="p-6 max-sm:p-4">

                    {{-- Profil --}}
                    <div class="flex items-center justify-between mb-8 max-sm:flex-col max-sm:items-start max-sm:gap-5">

                        <div class="flex items-center gap-5">

                            <div class="w-20 h-20 rounded-full bg-blue-50 border-4 border-blue-100 flex items-center justify-center">

                                <span class="text-2xl font-bold text-blue-700">
                                    {{ strtoupper(substr($employe->user->nom, 0, 1)) }}{{ strtoupper(substr($employe->user->prenom, 0, 1)) }}
                                </span>

                            </div>

                            <div>

                                <h2 class="text-2xl font-semibold text-gray-800 max-sm:text-xl">
                                    {{ $employe->user->nom }}
                                    {{ $employe->user->prenom }}
                                </h2>

                                <p class="text-gray-500 mt-1">
                                    {{ $employe->user->email }}
                                </p>

                            </div>

                        </div>


                        {{-- Rôle --}}
                        <div class="max-sm:ml-24">

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium">

                                <i data-feather="shield" class="w-4 h-4"></i>

                                {{ $employe->user->getRoleNames()->first() }}

                            </span>

                        </div>

                    </div>


                    {{-- Titre section --}}
                    <div class="mb-4">

                        <h4 class="text-lg font-semibold text-gray-800">
                            Informations personnelles
                        </h4>

                        <div class="w-10 h-1 bg-blue-600 rounded-full mt-2"></div>

                    </div>


                    {{-- Informations --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                        {{-- Nom --}}
                        <div class="group border border-gray-200 rounded-xl p-5 hover:border-blue-200 hover:shadow-sm transition">

                            <div class="flex items-start gap-4">

                                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">

                                    <i data-feather="user" class="w-5 h-5 text-blue-600"></i>

                                </div>

                                <div>

                                    <p class="text-sm text-gray-500 mb-1">
                                        Nom complet
                                    </p>

                                    <p class="text-base font-semibold text-gray-800">
                                        {{ $employe->user->nom }}
                                        {{ $employe->user->prenom }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Contact --}}
                        <div class="group border border-gray-200 rounded-xl p-5 hover:border-green-200 hover:shadow-sm transition">

                            <div class="flex items-start gap-4">

                                <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center shrink-0">

                                    <i data-feather="phone" class="w-5 h-5 text-green-600"></i>

                                </div>

                                <div>

                                    <p class="text-sm text-gray-500 mb-1">
                                        Contact
                                    </p>

                                    <p class="text-base font-semibold text-gray-800">
                                        {{ $employe->user->contacte }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Email --}}
                        <div class="group border border-gray-200 rounded-xl p-5 hover:border-purple-200 hover:shadow-sm transition">

                            <div class="flex items-start gap-4">

                                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center shrink-0">

                                    <i data-feather="mail" class="w-5 h-5 text-purple-600"></i>

                                </div>

                                <div class="min-w-0">

                                    <p class="text-sm text-gray-500 mb-1">
                                        Adresse email
                                    </p>

                                    <p class="text-base font-semibold text-gray-800 break-all">
                                        {{ $employe->user->email }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Rôle --}}
                        <div class="group border border-gray-200 rounded-xl p-5 hover:border-yellow-200 hover:shadow-sm transition">

                            <div class="flex items-start gap-4">

                                <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center shrink-0">

                                    <i data-feather="briefcase" class="w-5 h-5 text-yellow-600"></i>

                                </div>

                                <div>

                                    <p class="text-sm text-gray-500 mb-1">
                                        Fonction
                                    </p>

                                    <p class="text-base font-semibold text-gray-800">
                                        {{ $employe->user->getRoleNames()->first() }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Informations système --}}
                    <div class="mt-8 pt-6 border-t border-gray-100">

                        <div class="flex items-center gap-2 text-sm text-gray-500">

                            <i data-feather="info" class="w-4 h-4"></i>

                            <span>
                                Les informations de connexion sont sécurisées.
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </x-slot>

</x-app-layout>