<x-app-layout> 

    <x-slot>


        <div class="w-full p-6 flex justify-center items-center">
            <div class="w-full">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-baseline gap-4 mb-6">
                    <div>
                        <h1 class="text-blue-700 font-medium text-2xl max-sm:text-xl">
                            Détails du client
                        </h1>
                    </div>
                    <div class="flex items-center gap-2 w-60 max-sm:w-full">
                        <a href="{{ route('clients.index') }}" class="w-full">
                            <x-primary-button class="w-full justify-center">
                                Liste
                            </x-primary-button>
                        </a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="w-full">
                            <x-primary-button class="w-full justify-center bg-yellow-700 hover:bg-yellow-600">
                                Modifier
                            </x-primary-button>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-md shadow p-6">

                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">
                            Informations du client
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-lg text-gray-500">Nom client</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $client->user->nom }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Prenom</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $client->user->prenom }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Contacte</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $client->user->contacte }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Email</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $client->user->email }}
                            </p>
                        </div>


                        <div>
                            <p class="text-lg text-gray-500">Menage</p>
                            <p class="mt-1 font-medium text-gray-800">
                                @forelse ($client->menages as $menage)
                                    <div>{{ $menage->designation }}</div>
                                @empty
                                    Aucun menage
                                @endforelse
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Est abonnee</p>
                            <p class="mt-1 font-medium text-gray-800">
                                @forelse ($client->menages as $menage)
                                    <div>{{ $menage->est_abonnee }}</div>
                                @empty
                        
                                @endforelse
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Est en regle</p>
                            <p class="mt-1 font-medium text-gray-800">
                                 @forelse ($client->menages as $menage)
                                    <div>{{ $menage->est_en_regle }}</div>
                                @empty
                        
                                @endforelse
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Type Habitat</p>
                            <p class="mt-1 font-medium text-gray-800">
                                @forelse ($client->menages as $menage)
                                    <div>{{ $menage->type_habitat_id }}</div>
                                @empty

                                @endforelse
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>   


    </x-slot>

</x-app-layout>

