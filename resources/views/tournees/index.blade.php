<x-app-layout>
    <x-slot>
        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Liste des tournees
                        </h1>
                    </div>

                    @can('tournee.creer')
                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('tournees.create') }}">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Ajouter') }}
                            </x-secondary-button>
                        </a>

                    </div>
                    @endcan
                </div>

                {{--filtre --}}
                <div class=" card  mt-[-50px] p-5 mx-4 mb-6 ">

                    <form method="GET" action="{{ route('tournees.index') }}">

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

                            {{-- status --}}
                            <div>
                                <label for="etat" class="block text-sm font-medium text-gray-700 mb-1">
                                    Status
                                </label>

                                <select name="status" id="status"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Tous</option>

                                    <option value="PREVU" {{ request('status')==='PREVU' ? 'selected' : '' }}>
                                        PREVU
                                    </option>

                                    <option value="EN_COUR" {{ request('status')==='EN_COUR' ? 'selected' : '' }}>
                                        EN COUR
                                    </option>

                                    <option value="TERMINEE" {{ request('status')==='TERMINEE' ? 'selected' : '' }}>
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

                            <a href="{{ route('tournees.index') }}">
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
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3">Zone</th>
                                <th scope="col" class="px-6 py-3">Nombre d'employé</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Date </th>
                                <th scope="col" class="px-6 py-3">Itineraire</th>
                                <th scope="col" class="px-6 py-3 flex justify-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y ">
                            @forelse($tournees as $tournee)
                            <tr class="border-gray-300 border-b hover:bg-gray-100 ">

                                <td class="py-3 px-6 text-left">{{ $tournee->zone->designation }}</td>
                                <td class="py-3 px-6 text-center">{{ $tournee->nbr_employe() }}</td>


                                <td class="py-3 px-6 text-left">
                                    @if ( $tournee->status=="TERMINEE")

                                    <span
                                        class="bg-green-200 px-2 py-1 text-green-900 text-sm font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                        $tournee->status }}</span>
                                </td>
                                @elseif ( $tournee->status=="EN_COUR")

                                <span class="bg-yellow-200 px-2 py-1 text-yellow-600 text-sm
                                          font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                    $tournee->status }}</span>

                                @elseif ( $tournee->status=="PREVU")

                                <span class="bg-blue-200 px-2 py-1 text-blue-600 text-sm
                                          font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                    $tournee->status }}</span>

                                @endif
                                </td>

                                <td class="py-3 px-6 text-left">{{ $tournee->date }}</td>
                                <td class="py-3 px-6 text-left">{{ $tournee->itineraire }}</td>


                                <td class="py-3 px-6 text-left flex justify-center items-center gap-2">

                                    <a href="{{ route('tournees.show', $tournee->id) }}">
                                        <x-secondary-button
                                            class="bg-blue-700 text-white border-blue-700 hover:bg-blue-600 hover:border-blue-600 focus:ring-blue-300">
                                            Voire
                                        </x-secondary-button>
                                    </a>

                                    @if ($tournee->status=="PREVU" )
                                    @can('tournee.modifier')
                                    <a href="{{ route('tournees.edit', $tournee->id) }}">
                                        <x-secondary-button
                                            class="bg-yellow-700 text-white border-yellow-700 hover:bg-yellow-600 hover:border-yellow-600 focus:ring-yellow-300">
                                            Modifier
                                        </x-secondary-button>
                                    </a>
                                    @endcan

                                    @can('tournee.annuler')
                                    <form action="{{ route('tournees.annuler', $tournee->id) }}" method="post">
                                        @csrf
                                        <x-secondary-button type="submit"
                                            class="bg-red-700 text-white border-red-700 hover:bg-red-600 hover:border-red-600 focus:ring-red-300">
                                            Annuler
                                        </x-secondary-button>
                                    </form>
                                    @endcan
                                    @endif



                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class=" w-full flex items-center justify-center py-3 px-6 text-center">
                                    Aucune tournee</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="m-4">
                    {{$tournees->links()}}
                </div>
            </div>

        </div>
    </x-slot>
</x-app-layout>