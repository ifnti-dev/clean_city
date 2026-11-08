<x-app-layout>
    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Liste des factures
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('factures.create') }}">
                            @can('facture.creer')
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
                    <form method="get" action="{{ route('factures.index') }}" class="search-filter">
                        @csrf
                        <div class="search-filter-fields">
                            {{-- Recherche --}}

                            <div class="flex flex-col gap-5 lg:col-span-4 justify-center">

                                <p class="flex flex-col">Rechercher par perriode et par montant</p>
                                
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                    <div class="w-full ">
                                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                            Date Debut
                                        </label>
                                        <input type="date" name="date_debut" id="date_debut"
                                            value="{{ $date_debut }}" placeholder="Date debut"
                                            class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div class="w-full">
                                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                            Date Fin
                                        </label>
                                        <input type="date" name="date_fin" id="date_fin" value="{{ $date_fin }}"
                                            placeholder="Date fin"
                                            class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <div class="w-full">
                                        <label for="montant"
                                            class="block text-sm font-medium text-gray-700 mb-1">Montant</label>
                                        <input type="text" name="montant" id="montant" value="{{ $montant }}"
                                            placeholder="montant "
                                            class="rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    </div>


                                </div>

                            </div>
                        </div>



                        {{-- Boutons --}}
                        <div class="search-filter-actions">

                            <a href="{{ route('factures.index') }}">
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



                <div class="relative mx-4 overflow-x-auto card shadow mb-5">
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3">Nombre de mois</th>
                                <th scope="col" class="px-6 py-3">Date Debut</th>
                                <th scope="col" class="px-6 py-3">Date Fin</th>
                                {{-- <th scope="col" class="px-6 py-3">Mois</th> --}}
                                <th scope="col" class="px-6 py-3">Montant</th>
                                <th scope="col" class="px-6 py-3">Etat Paiement</th>
                                {{-- <th scope="col" class="px-6 py-3">Transaction ID</th> --}}
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y ">
                            @forelse ($factures as $facture)
                                <tr class="border-gray-300 border-b hover:bg-gray-100 ">

                                    <td class="py-3 px-6 text-left">{{ $facture->nb_mois }}

                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $facture->date_debut }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $facture->date_fin }}
                                    </td>
                                    {{-- <td class="py-3 px-6 text-left">
                                        @forelse (($facture->les_mois)  as $mois)
                                            {{ $mois . ',' }}
                                        @empty
                                            <p>Acun mois</p>
                                        @endforelse


                                    </td> --}}
                                    <td class="py-3 px-6 text-left"><span
                                            class="bg-green-200 px-2 py-1 text-green-900 text-sm font-medium rounded-md inline-block">{{ $facture->montant }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-left"><span
                                            class="bg-blue-200 px-2 py-1 text-blue-900 text-sm font-medium rounded-md inline-block">{{ $facture->etat_paiement }}
                                        </span></td>



                                    <td class="px-6 py-3 text-right align-middle">
                                        @can('facture.voire')
                                            <x-action-menu :id="'facture-actions-' . $facture->id">
                                                <a class="action-menu-item" href="{{ route('factures.show', $facture->id) }}">Voir</a>
                                            </x-action-menu>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"> Aucun paiement </td>
                                </tr>
                            @endforelse

                        </tbody>



                    </table>
                </div>

            </div>
        </div>


    </x-slot>

</x-app-layout>
