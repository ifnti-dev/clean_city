<x-app-layout>

    <x-slot>

        <div class="w-full p-2 flex justify-center items-center">

            <div class="w-full m-2">

                {{-- En-tête --}}
                <div class="flex justify-between items-baseline mt-6 mb-6">

                    <div>
                        <h1 class="text-blue-700 font-medium text-2xl max-sm:pl-2 max-sm:text-xl">
                            Liste des quartiers
                        </h1>
                    </div>

                    <div class="flex items-center justify-end max-sm:pr-8 mt-6 w-60 max-sm:w-full">

                        <a href="{{ route('quartiers.create') }}">

                            <x-primary-button class="w-full justify-center max-sm:py-2 max-sm:text-sm">

                                {{ __('Ajouter') }}

                            </x-primary-button>

                        </a>

                    </div>

                </div>


                {{-- Filtres --}}
                <div class="card shadow mb-6 p-5">

                    <form method="GET" action="{{ route('quartiers.index') }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                            {{-- Recherche --}}
                            <div class="lg:col-span-2">

                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">

                                    Recherche

                                </label>

                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Désignation du quartier..."
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            </div>

                        </div>

                        {{-- Boutons --}}
                        <div class="flex justify-end gap-3 mt-5">

                            <a href="{{ route('quartiers.index') }}">

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


                {{-- Tableau --}}
                <div class="relative overflow-x-auto card shadow m-2">

                    <table class="text-left w-full whitespace-nowrap">

                        <thead>

                            <tr class="border-gray-300 border-b flex  items-center">

                                <th scope="col" class="w-full text-center px-6 py-3">
                                    Nom du quartier
                                </th>


                                <th scope="col" class="w-full text-center px-6 py-3">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @forelse ($quartiers as $quartier)

                            <tr class="border-gray-300 border-b hover:bg-gray-100 flex  items-center">

                                <td class="py-3 px-6 w-full text-center">

                                    {{ $quartier->designation }}

                                </td>


                                <td
                                    class=" py-3 px-6 flex justify-center items-center gap-2 w-full text-center">

                                    {{-- Modifier --}}
                                    <a href="{{ route('quartiers.edit', $quartier->id) }}">

                                        <x-secondary-button
                                            class="bg-yellow-700 text-white border-yellow-700 hover:bg-yellow-600">

                                            Modifier

                                        </x-secondary-button>

                                    </a>


                                    {{-- Supprimer --}}
                                    <form method="POST" action="{{ route('quartiers.destroy', $quartier->id) }}"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer ce quartier ?')">

                                        @csrf

                                        @method('DELETE')

                                        <x-secondary-button type="submit"
                                            class="bg-red-700 text-white border-red-700 hover:bg-red-600">

                                            Supprimer

                                        </x-secondary-button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="3" class="py-3 px-6 text-center">

                                    Aucun quartier

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="m-4">

                    {{ $quartiers->links() }}

                </div>

            </div>

        </div>

    </x-slot>

</x-app-layout>