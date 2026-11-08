<x-app-layout>
    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Liste des commandes
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="">
                            @can('commandes.creer')
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
                    <form method="get" action="{{ route('commandes.index') }}" class="search-filter">
                        @csrf
                        <div class="search-filter-fields">
                            {{-- Recherche --}}
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Recherche
                                </label>

                                <input type="search" name="search" id="search" value="{{ $search }}"
                                    placeholder="status Commande"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        {{-- Boutons --}}
                        <div class="search-filter-actions">

                            <a href="{{ route('commandes.index') }}">
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
                                <th scope="col" class="px-6 py-3">Montant</th>
                                <th scope="col" class="px-6 py-3">Est accepte</th>
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Statut de la livraison</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y ">
                            @forelse ($commandes as $commande)
                                <tr class="border-gray-300 border-b hover:bg-gray-100 ">
                                    <td class="py-3 px-6 text-left">{{ $commande->montant }}</td>
                                    <td class="py-3 px-6 text-left">
                                        @if ($commande->est_accepte)
                                            <p class="bg-green-200 px-2 py-1 text-green-900 text-sm font-medium rounded-md inline-block" >OUI</p>
                                        @else
                                            <p class="bg-red-200 px-2 py-1 text-red-900 text-sm font-medium rounded-md inline-block  ">NON</p>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-left">{{ $commande->date }}</td>
                                    <td class="py-3 px-6 text-left"><span class="bg-green-200 px-2 py-1 text-green-900 text-sm font-medium rounded-md inline-block "> {{ $commande->statut_livraison }} </span></td>

                                    <td class="px-6 py-3 text-right align-middle">
                                        @if (in_array($commande->statut_livraison, ['EN_ATTENTE', 'DEBUTER'], true))
                                            <x-action-menu :id="'commande-actions-' . $commande->id">
                                                @if ($commande->statut_livraison == 'EN_ATTENTE')
                                                    <form action="{{ route('commandes.debuterLivraison', $commande->id) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="action-menu-item">Démarrer la livraison</button>
                                                    </form>
                                                @elseif ($commande->statut_livraison == 'DEBUTER')
                                                    <form action="{{ route('commandes.livrerLaCommande', $commande->id) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="action-menu-item">Confirmer la livraison</button>
                                                    </form>
                                                @endif
                                            </x-action-menu>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"> Aucun produits disponible </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="p-4 mb-12 ">
            {{ $commandes->links() }}
        </div>


    </x-slot>

</x-app-layout>
