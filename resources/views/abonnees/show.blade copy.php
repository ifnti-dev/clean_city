<x-app-layout>
    <x-slot>

        <div class="w-full p-6 flex justify-center items-center">
            <div class="w-full">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-baseline gap-4 mb-6">
                    <div>
                        <h1 class="text-blue-700 font-medium text-2xl max-sm:text-xl">
                            Détails de l'abonnement
                        </h1>
                    </div>
                    <div class="flex items-center gap-2 w-60 max-sm:w-full">
                        <a href="{{ route('abonnements.index') }}" class="w-full">
                            <x-primary-button class="w-full justify-center">
                                Liste
                            </x-primary-button>
                        </a>
                        <a href="{{ route('abonnements.edit', $abonnement->id) }}" class="w-full">
                            <x-primary-button class="w-full justify-center bg-yellow-700 hover:bg-yellow-600">
                                Modifier
                            </x-primary-button>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-md shadow p-6">

                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">
                            Informations de l'abonnement
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-lg text-gray-500">Code ménage</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $abonnement->menage->code }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Désignation</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $abonnement->menage->designation }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Responsable</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $abonnement->menage->client->user->nom }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Type d'habitat</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $abonnement->menage->typeHabitat->designation }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Quartier</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $abonnement->menage->quartier->designation }}
                            </p>
                        </div>

                    

                        <div>
                            <p class="text-lg text-gray-500">Date de début</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $abonnement->date_debut }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Date de fin</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $abonnement->date_fin ?? '---' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">État</p>
                            <div class="mt-1">
                                @if ($abonnement->etat == "ACTIF")
                                    <span class="bg-green-200 px-2 py-1 text-green-900 text-lg font-medium rounded-md">
                                        {{ $abonnement->etat }}
                                    </span>
                                @else
                                    <span class="bg-red-200 px-2 py-1 text-red-600 text-lg font-medium rounded-md">
                                        {{ $abonnement->etat }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">En règle</p>
                            <div class="mt-1">
                                @if ($abonnement->menage->est_en_regle == 1)
                                    <span class="bg-green-200 px-2 py-1 text-green-900 text-lg font-medium rounded-md">
                                        Oui
                                    </span>
                                @else
                                    <span class="bg-red-200 px-2 py-1 text-red-600 text-lg font-medium rounded-md">
                                        Non
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Longitude</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $abonnement->menage->longitude }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Latitude</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $abonnement->menage->latitude }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </x-slot>
</x-app-layout>