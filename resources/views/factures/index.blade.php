<x-app-layout>

    <x-slot>
        <div class="w-full p-2 flex justify-center items-center ">
            <div class="w-full m-2">
                <div class="flex justify-between items-baseline  mt-6 mb-6">

                    <div>
                        <h1>Liste des paiements</h1>
                    </div>

                    <div class="flex items-center justify-center mt-6 w-40">

                       
                            <a href="{{ route('factures.create') }}">
                                <x-primary-button class="w-full justify-center">
                                    {{ __('Ajouter') }}
                                </x-primary-button>
                            </a>
                      
                    </div>
                </div>

                <div class="card shadow mb-6 p-5">
                    <form method="get" action="{{ route('factures.index') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 ">
                            {{-- Recherche --}}
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Recherche
                                </label>

                                <input type="text" name="search" id="search" value=""
                                    placeholder="....."
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



                <div class="relative overflow-x-auto card shadow">
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
                                    <td class="py-3 px-6 text-left">{{ $facture->nb_mois }}</td>
                                    <td class="py-3 px-6 text-left">{{ $facture->date_debut }}</td>
                                    <td class="py-3 px-6 text-left">{{ $facture->date_fin }}</td>
                                    <td class="py-3 px-6 text-left">{{ $facture->mois}}</td>
                                    <td class="py-3 px-6 text-left">{{ $facture->montant}}</td>
                                    <td class="py-3 px-6 text-left">{{ $facture->id_transaction }}</td>
                                   


                                    <td class=" flex item-center gap-6 px-3 py-3 text-left ">
                                     
                                            <a href="">
                                                <x-secondary-button
                                                    class="bg-blue-700 text-white border-blue-700 hover:bg-blue-600 hover:border-blue-600 focus:ring-blue-700">
                                                    Voire
                                                </x-secondary-button>
                                            </a>
                                    

                                       
                                            <a href="">
                                                <x-secondary-button
                                                    class="bg-yellow-700 text-white border-yellow-700 hover:bg-yellow-600 hover:border-yellow-600 focus:ring-yellow-300">
                                                    Modifier
                                                </x-secondary-button>
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
