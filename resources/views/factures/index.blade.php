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
                            @can('paiement.creer')
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
                    <form method="get" action="{{ route('factures.index') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 ">
                            {{-- Recherche --}}
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Recherche
                                </label>

                                <input type="text" name="search" id="search" value="{{ $search }}"
                                    placeholder="Date debut, Date fin "
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>   

                        </div>

                        

                        {{-- Boutons --}}
                        <div class="flex justify-end gap-3 mt-5">

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
                                <th scope="col" class="px-6 py-3">Mois</th>
                                <th scope="col" class="px-6 py-3">Montant</th>
                                <th scope="col" class="px-6 py-3">Transaction ID</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y ">
                            @forelse ($factures as $facture)
                                <tr class="border-gray-300 border-b hover:bg-gray-100 ">

                                    <td class="py-3 px-6 text-left">{{ $facture->nb_mois }}
                                       
                                    </td>
                                    <td class="py-3 px-6 text-left">{{ $facture->date_debut }}</td>
                                    <td class="py-3 px-6 text-left">{{ $facture->date_fin }}</td>
                                    <td class="py-3 px-6 text-left">
                                        @forelse ( ($facture->les_mois)  as $mois)
                                            {{ $mois}}-
                                        @empty
                                            <p>Acun mois</p>
                                        @endforelse
                                        

                                    </td>
                                    <td class="py-3 px-6 text-left">{{ $facture->montant}}</td>
                                    <td class="py-3 px-6 text-left">{{ $facture->id_transaction }}</td>
                                   


                                    <td class=" flex item-center gap-6 px-3 py-3 text-left ">
                                     
                                            <a href="{{ route('factures.show', $facture->id) }}">
                                                @can('paiement.voire')
                                                    <x-secondary-button
                                                        class="bg-blue-700 text-white border-blue-700 hover:bg-blue-600 hover:border-blue-600 focus:ring-blue-700">
                                                        Voire
                                                    </x-secondary-button>
                                                @endcan
                                                
                                            </a>
                                    

                                       
                                            <a href="{{ route('factures.edit', $facture->id) }}">
                                                @can('paiement.modifier')
                                                    <x-secondary-button
                                                        class="bg-yellow-700 text-white border-yellow-700 hover:bg-yellow-600 hover:border-yellow-600 focus:ring-yellow-300">
                                                        Modifier
                                                    </x-secondary-button>
                                                @endcan
                                               
                                            </a>
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
