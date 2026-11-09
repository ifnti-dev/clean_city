<x-app-layout>
    <x-slot>
        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl"> Liste des Zones
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('zones.create') }}">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Ajouter') }}
                            </x-secondary-button>
                        </a>

                    </div>
                </div>

                {{--filtre --}}
                <div class=" card  mt-[-50px] p-5 mx-4 mb-6 ">

                    <form method="GET" action="{{ route('zones.index') }}" class="search-filter">

                        <div class="search-filter-fields">

                            {{-- Recherche --}}
                            <div class="lg:col-span-2">

                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">

                                    Recherche

                                </label>

                                <input type="search" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Désignation du zone..."
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            </div>

                        </div>

                        {{-- Boutons --}}
                        <div class="search-filter-actions">

                            <a href="{{ route('zones.index') }}">

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


                
                <div class="relative overflow-x-auto card shadow mx-4">

                    <table class="w-full table-fixed text-left">

                        <thead>

                            <tr class="border-gray-300 border-b">

                                <th scope="col" class="w-3/4 px-6 py-3">
                                    Nom du Zone
                                </th>


                                <th scope="col" class="w-1/4 px-6 py-3 text-right">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @forelse ($zones as $zone)

                            <tr class="border-gray-300 border-b hover:bg-gray-100">

                                <td class="py-3 px-6">

                                    {{ $zone->designation }}

                                </td>
                                <td class="px-6 py-3 align-middle">
                                    <div class="flex justify-end">
                                        <x-action-menu :id="'zone-actions-' . $zone->id">
                                            <a class="action-menu-item" href="{{ route('zones.show', $zone->id) }}">Voir</a>
                                            <a class="action-menu-item" href="{{ route('zones.edit', $zone->id) }}">Modifier</a>
                                            <form method="POST" action="{{ route('zones.destroy', $zone->id) }}"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer ce zone ?')">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="action-menu-item action-menu-item-danger">Supprimer</button>
                                            </form>

                                        </x-action-menu>
                                    </div>
                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="3" class="py-3 px-6 text-center">

                                    Aucun zone

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="m-4">

                    {{ $zones->links() }}

                </div>

            </div>

        </div>

    </x-slot>

</x-app-layout>