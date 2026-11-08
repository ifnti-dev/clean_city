<x-app-layout>
    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Liste des clients
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('clients.create') }}">
                            @can('client.creer')
                                <x-secondary-button
                                    class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                    {{ __('Ajouter') }}
                                </x-secondary-button>
                            @endcan
                            
                        </a>
                    </div>
                </div>

                {{-- filtre --}}
                <!-- <div class="card shadow mb-6 p-5"> -->
                <div class=" card  mt-[-50px] p-5 mx-4 mb-6 ">
                    <form method="get" action="{{ route('clients.index') }}" class="search-filter">
                        @csrf
                        <div class="search-filter-fields">
                            {{-- Recherche --}}
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Recherche
                                </label>

                                <input type="search" name="search" id="search" value="{{ $search }}"
                                    placeholder="Nom, prenom, contacte, ..."
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="en_regle" class="block text-sm font-medium text-gray-700 mb-1">
                                    Est abonnee
                                </label>

                                <select name="abonnee" id="abonnee"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Tous</option>

                                    <option value="1" {{ (string) $abonnee === '1' ? 'selected' : '' }}>
                                        Oui
                                    </option>

                                    <option value="0" {{ (string) $abonnee === '0' ? 'selected' : '' }}>
                                        Non
                                    </option>
                                </select>
                            </div>



                        </div>

                        {{-- Boutons --}}
                        <div class="search-filter-actions">

                            <a href="{{ route('clients.index') }}">
                                <x-secondary-button type="button"
                                    class="bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200">
                                    Réinitialiser
                                </x-secondary-button>
                            </a>

                            <x-primary-button>
                                Filtrer
                            </x-primary-button>

                        </div>

                    </form>
                </div>



                <div class="relative mx-4 overflow-x-auto card shadow">
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3">Nom</th>
                                <th scope="col" class="px-6 py-3">Prenom</th>
                                <th scope="col" class="px-6 py-3">Contacte</th>
                                <th scope="col" class="px-6 py-3">Email</th>

                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y ">
                            @forelse ($clients as $client)
                                <tr class="border-gray-300 border-b hover:bg-gray-100 ">
                                    <td class="py-3 px-6 text-left">{{ $client->user->nom }}</td>
                                    <td class="py-3 px-6 text-left">{{ $client->user->prenom }}</td>
                                    <td class="py-3 px-6 text-left">{{ $client->user->contacte }}</td>
                                    <td class="py-3 px-6 text-left">{{ $client->user->email }}</td>
                                   


                                    <td class="px-6 py-3 text-right align-middle">
                                        @canany(['client.voire', 'client.modifier', 'client.supprimer'])
                                            <x-action-menu :id="'client-actions-' . $client->id">
                                                @can('client.voire')
                                                    <a class="action-menu-item" href="{{ route('clients.show', $client->id) }}">Voir</a>
                                                @endcan
                                                @can('client.modifier')
                                                    <a class="action-menu-item" href="{{ route('clients.edit', $client->id) }}">Modifier</a>
                                                @endcan
                                                @can('client.supprimer')
                                                    <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                        <button type="submit" class="action-menu-item action-menu-item-danger">Supprimer</button>
                                                    </form>
                                                @endcan
                                            </x-action-menu>
                                        @endcanany
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

            </div>
        </div>

        <div class="p-4 mb-12 ">
            {{ $clients->links() }}
        </div>


    </x-slot>

</x-app-layout>
