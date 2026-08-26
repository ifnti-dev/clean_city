<x-app-layout>

    <x-slot>

        <div class="w-full m-5 p-5 bg-white">
            <div class="flex justify-between items-baseline  mt-6 mb-6">

                <div>
                    <h1>Liste des clients</h1>
                </div>

                <div class="flex items-center justify-center mt-6 w-40">

                    @can('client.creer')
                        <a href="{{ route('clients.create') }}">
                            <x-primary-button class="w-full justify-center">
                                {{ __('Ajouter') }}
                            </x-primary-button>
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card shadow mb-6 p-5 m-7">
                <form method="get" action="{{ route('clients.index') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 ">
                        {{-- Recherche --}}
                        <div class="lg:col-span-2">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                Recherche
                            </label>

                            <input type="text" name="search" id="search" value="{{ $search }}"
                                placeholder="Nom, prenom, contacte, email ..."
                                class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>   
                    </div>

                    {{-- Boutons --}}
                    <div class="flex justify-end gap-3 mt-5">

                        <a href="{{ route('clients.index') }}">
                            <x-secondary-button type="button"
                                class="bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200">
                                Réinitialiser
                            </x-secondary-button>
                        </a>

                        <x-primary-button type="submit">
                            Filtrer
                        </x-primary-button>

                    </div>

                </form>
            </div> 




            <body>
                <div class="relative overflow-x-auto">
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3">Id</th>
                                <th scope="col" class="px-6 py-3">Nom</th>
                                <th scope="col" class="px-6 py-3">Prenom</th>
                                <th scope="col" class="px-6 py-3">Contacte</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Designation menage</th>

                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y ">
                            @forelse ($clients as $client)
                                <tr class="border-gray-300 border-b hover:bg-gray-100 ">
                                    <td class="py-3 px-6 text-left">{{ $client->id }}</td>
                                    <td class="py-3 px-6 text-left">{{ $client->user->nom }}</td>
                                    <td class="py-3 px-6 text-left">{{ $client->user->prenom }}</td>
                                    <td class="py-3 px-6 text-left">{{ $client->user->contacte }}</td>
                                    <td class="py-3 px-6 text-left">{{ $client->user->email }}</td>
                                    <td class="py-3 px-6 text-left">
                                        @forelse ($client->menages as $menage)
                                            <div>{{ $menage->designation }}</div>
                                        @empty
                                            Aucun menage
                                        @endforelse
                                    </td>


                                    <td class=" flex item-center gap-6 px-3 py-3 text-left ">
                                        @can('client.voire')
                                            <a href="{{ route('clients.show', $client->id) }}">
                                                <x-secondary-button
                                                    class="bg-blue-700 text-white border-blue-700 hover:bg-blue-600 hover:border-blue-600 focus:ring-blue-700">
                                                    Voire
                                                </x-secondary-button>
                                            </a>
                                        @endcan


                                        @can('client.modifier')
                                            <a href="{{ route('clients.edit', $client->id) }}">
                                                <x-secondary-button
                                                    class="bg-yellow-700 text-white border-yellow-700 hover:bg-yellow-600 hover:border-yellow-600 focus:ring-yellow-300">
                                                    Modifier
                                                </x-secondary-button>
                                            </a>
                                        @endcan

                                        @can('client.supprimer')
                                            <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <x-secondary-button type="submit"
                                                    class="bg-red-700 text-white border-red-700 hover:bg-red-600 hover:border-red-600 focus:ring-red-300">
                                                    Supprimer
                                                </x-secondary-button>
                                            </form>
                                        @endcan

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"> Aucun client </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </body>
        </div>
    </x-slot>

</x-app-layout>
