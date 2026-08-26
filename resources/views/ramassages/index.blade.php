<x-app-layout>
    <x-slot>

        <div class="w-full p-2 flex justify-center items-center ">

            <div class="w-full m-2">
                <div class="flex justify-between items-baseline  mt-6 mb-6">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-blue-700 font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Liste des ramassages
                        </h1>
                    </div>

                    <div class="flex items-center justify-end  max-sm:pr-8 mt-6 w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('ramassages.create') }}">
                            <x-primary-button class="w-full justify-center max-sm:py-2 max-sm:text-sm">
                                {{ __('Ajouter') }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>

                {{-- Filtres --}}
                <div class="card shadow mb-6 p-5">

                    <form method="GET" action="{{ route('ramassages.index') }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

                            {{-- Recherche --}}
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Recherche
                                </label>

                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Nom employee ou Designation zone..."
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            {{-- statut --}}
                            <div>
                                <label for="etat" class="block text-sm font-medium text-gray-700 mb-1">
                                    Statut
                                </label>

                                <select name="statut" id="statut"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Tous</option>

                                    <option value="PREVU" {{ request('statut')==='PREVU' ? 'selected' : '' }}>
                                        PREVU
                                    </option>

                                    <option value="EN_COUR" {{ request('statut')==='EN_COUR' ? 'selected' : '' }}>
                                        EN COUR
                                    </option>

                                    <option value="TERMINEE" {{ request('statut')==='TERMINEE' ? 'selected' : '' }}>
                                        TERMINER
                                    </option>
                                </select>
                            </div>


                            {{-- Date --}}
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
                                    Date Debut
                                </label>

                                <input type="date" name="date_debut" id="date_debut" value="{{ request('date_debut') }}"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                             {{-- Date fin --}}
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
                                    Date Fin
                                </label>

                                <input type="date" name="date_fin" id="date_fin" value="{{ request('date_fin') }}"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>


                        </div>

                        {{-- Boutons --}}
                        <div class="flex justify-end gap-3 mt-5">

                            <a href="{{ route('ramassages.index') }}">
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

                <div class="relative overflow-x-auto card shadow">
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3">Code</th>
                                <th scope="col" class="px-6 py-3">Employee</th>
                                <th scope="col" class="px-6 py-3">Zone</th>
                                <th scope="col" class="px-6 py-3">Statut</th>
                                <th scope="col" class="px-6 py-3">Date </th>
                                <th scope="col" class="px-6 py-3">Itineraire</th>
                                <th scope="col" class="px-6 py-3 flex justify-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y ">
                            @forelse($ramassages as $ramassage)
                            <tr class="border-gray-300 border-b hover:bg-gray-100 ">

                                <td class="py-3 px-6 text-left">124</td>
                                <td class="py-3 px-6 text-left">{{ $ramassage->employe->user->nom }}</td>
                                <td class="py-3 px-6 text-left">{{ $ramassage->zone->designation }}</td>

                                @if ( $ramassage->statut=="TERMINEE")
                                <td class="py-3 px-6 text-left">
                                    <span
                                        class="bg-green-200 px-2 py-1 text-green-900 text-sm font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                        $ramassage->statut }}</span>
                                </td>
                                @elseif ( $ramassage->statut=="EN_COUR")
                                <td class="py-3 px-6 text-left">
                                    <span class="bg-yellow-200 px-2 py-1 text-yellow-600 text-sm
                                          font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                        $ramassage->statut }}</span>
                                </td>
                                @elseif ( $ramassage->statut=="PREVU")
                                <td class="py-3 px-6 text-left">
                                    <span class="bg-blue-200 px-2 py-1 text-blue-600 text-sm
                                          font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                        $ramassage->statut }}</span>
                                </td>
                                @endif

                                <td class="py-3 px-6 text-left">{{ $ramassage->date }}</td>
                                <td class="py-3 px-6 text-left">{{ $ramassage->itineraire }}</td>


                                <td class="py-3 px-6 text-left flex  items-center gap-2">

                                    @if ($ramassage->statut=="PREVU" )

                                    <a href="{{ route('ramassages.edit', $ramassage->id) }}">
                                        <x-secondary-button
                                            class="bg-yellow-700 text-white border-yellow-700 hover:bg-yellow-600 hover:border-yellow-600 focus:ring-yellow-300">
                                            Modifier
                                        </x-secondary-button>
                                    </a>

                                    <form action="{{ route('ramassages.demarer', $ramassage->id) }}" method="post">
                                        @csrf
                                        <x-secondary-button type="submit"
                                            class="bg-teal-700 text-white border-teal-700 hover:bg-teal-600 hover:border-teal-600 focus:ring-teal-300">
                                            Demarer
                                        </x-secondary-button>
                                    </form>


                                    <form action="{{ route('ramassages.annuler', $ramassage->id) }}" method="post">
                                        @csrf
                                        <x-secondary-button type="submit"
                                            class="bg-red-700 text-white border-red-700 hover:bg-red-600 hover:border-red-600 focus:ring-red-300">
                                            Annuler
                                        </x-secondary-button>
                                    </form>

                                    @elseif($ramassage->statut=="EN_COUR")

                                    <form action="{{ route('ramassages.terminer', $ramassage->id) }}" method="post">
                                        @csrf
                                        <x-secondary-button type="submit"
                                            class="bg-green-700 text-white border-green-700 hover:bg-green-600 hover:border-green-600 focus:ring-green-300">
                                            Terminer
                                        </x-secondary-button>
                                    </form>
                                    @endif

                                </td>

                            </tr>
                            @empty
                            <tr class=" flex justify-center items-center">
                                <td class=" flex items-center justify-center py-3 px-6 text-center">Aucun ramassage</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="m-4">
                    {{$ramassages->links()}}
                </div>
            </div>

        </div>
    </x-slot>
</x-app-layout>